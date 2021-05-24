<?php

namespace DI\Bundles\Common;

use Cluster;
use DI\AbstractContainer;
use DI\Configuration;
use Serializers;
use Services;
use Storages;

class Common extends AbstractContainer implements Container {
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
    $service = $this->get(Services\ProductsService::class);
    return $service;
  }

  public function getOrdersService(): Services\OrdersService {
    /** @var Services\OrdersService $service */
    $service = $this->get(Services\OrdersService::class);
    return $service;
  }

  /**
   * Manual lazy registration/injecting
   */
  protected function configure(): void {
    $this->register(Cluster\Meow::class, function(): Cluster\Meow {
      return new Cluster\Meow($this->getConfiguration()->getParameters()->get(\DI\Bundles\Common\Configuration::KEY_MEOW_ACTOR));
    });

    $this->register(Serializers\Orders\DefaultSerializer::class, function(): Serializers\Products\DefaultSerializer {
      return new Serializers\Products\DefaultSerializer();
    });

    $this->register(Serializers\Products\CacheSerializer::class, function(): Serializers\Products\CacheSerializer {
      return new Serializers\Products\CacheSerializer();
    });

    $this->register(Storages\ProductsStorage::class, function(): Storages\ProductsStorage {
      /** @var Cluster\Meow $cluster */
      $cluster = $this->get(Cluster\Meow::class);

      /** @var Storages\CacheStorage $cache */
      $cache = $this->get(Storages\CacheStorage::class);

      /** @var Serializers\Products\DefaultSerializer $engineSerializer */
      $engineSerializer = $this->get(Serializers\Products\DefaultSerializer::class);

      /** @var Serializers\Products\CacheSerializer $cacheSerializer */
      $cacheSerializer = $this->get(Serializers\Products\CacheSerializer::class);

      return new Storages\ProductsStorage($cluster, $cache, $engineSerializer, $cacheSerializer);
    });

    $this->register(Storages\OrdersStorage::class, function(): Storages\OrdersStorage {
      /** @var Cluster\Meow $cluster */
      $cluster = $this->get(Cluster\Meow::class);

      /** @var Storages\CacheStorage $cache */
      $cache = $this->get(Storages\CacheStorage::class);
      return new Storages\OrdersStorage($cluster, $cache);
    });

    $this->register(Services\OrdersService::class, function(): Services\OrdersService {
      /** @var Storages\OrdersStorage $storage */
      $storage = $this->get(Storages\OrdersStorage::class);
      return new Services\OrdersService($storage);
    });
  }
}
