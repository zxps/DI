<?php

namespace DI\Bundles\Common;

use Cluster;
use DI\AbstractContainer;
use DI\Configuration;
use Serializers;
use Services;
use Storages;

class Common extends AbstractContainer implements Container {
  private const ID_MEOW_CLUSTER  = 'meow_cluster';
  private const ID_CACHE_STORAGE = 'cache_storage';

  private const ID_PRODUCTS_DEFAULT_SERIALIZER = 'products_default_serializer';
  private const ID_PRODUCTS_CACHE_SERIALIZER   = 'products_cache_serializer';
  private const ID_PRODUCTS_SERVICE            = 'products_service';
  private const ID_PRODUCTS_STORAGE            = 'products_storage';

  private const ID_ORDERS_STORAGE = 'orders_storage';
  private const ID_ORDERS_SERVICE = 'orders_service';

  private Configuration $configuration;

  public function __construct(array $parameters = []) {
    $this->configuration = new \DI\Bundles\Common\Configuration($parameters);
    parent::__construct();
  }

  public function getConfiguration(): Configuration {
    return $this->configuration;
  }

  public function getProductsService(): Services\ProductsService {
    /** @var Services\ProductsService $service */
    $service = $this->get(self::ID_PRODUCTS_SERVICE);
    return $service;
  }

  public function getOrdersService(): Services\OrdersService {
    /** @var Services\OrdersService $service */
    $service = $this->get(self::ID_ORDERS_SERVICE);
    return $service;
  }

  /**
   * Manual lazy registration/injecting
   */
  protected function configure(): void {
    $this->register(self::ID_MEOW_CLUSTER, function(): Cluster\Meow {
      return new Cluster\Meow($this->getConfiguration()->getParameters()->get(\DI\Bundles\Common\Configuration::KEY_MEOW_ACTOR));
    });

    $this->register(self::ID_PRODUCTS_DEFAULT_SERIALIZER, function(): Serializers\Products\DefaultSerializer {
      return new Serializers\Products\DefaultSerializer();
    });

    $this->register(self::ID_PRODUCTS_CACHE_SERIALIZER, function(): Serializers\Products\CacheSerializer {
      return new Serializers\Products\CacheSerializer();
    });

    $this->register(self::ID_PRODUCTS_STORAGE, function(): Storages\ProductsStorage {
      /** @var Cluster\Meow $cluster */
      $cluster = $this->get(self::ID_MEOW_CLUSTER);

      /** @var Storages\CacheStorage $cache */
      $cache = $this->get(self::ID_CACHE_STORAGE);

      /** @var Serializers\Products\DefaultSerializer $engineSerializer */
      $engineSerializer = $this->get(self::ID_PRODUCTS_DEFAULT_SERIALIZER);

      /** @var Serializers\Products\CacheSerializer $cacheSerializer */
      $cacheSerializer = $this->get(self::ID_PRODUCTS_CACHE_SERIALIZER);

      return new Storages\ProductsStorage($cluster, $cache, $engineSerializer, $cacheSerializer);
    });

    $this->register(self::ID_ORDERS_STORAGE, function(): Storages\OrdersStorage {
      /** @var Cluster\Meow $cluster */
      $cluster = $this->get(self::ID_MEOW_CLUSTER);

      /** @var Storages\CacheStorage $cache */
      $cache = $this->get(self::ID_PRODUCTS_CACHE_SERIALIZER);
      return new Storages\OrdersStorage($cluster, $cache);
    });

    $this->register(self::ID_ORDERS_SERVICE, function(): Services\ProductsService {
      /** @var Storages\ProductsStorage $storage */
      $storage = $this->get(self::ID_ORDERS_STORAGE);

      return new Services\ProductsService($storage);
    });
  }
}
