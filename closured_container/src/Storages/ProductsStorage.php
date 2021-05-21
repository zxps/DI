<?php

namespace Storages;

use Cache\Cache;
use Cluster\Meow;
use Objects\Product;
use Serializers\Product\ProductSerializer;

class ProductsStorage {

  private Meow $cluster;

  private Cache $cache;

  private ProductSerializer $cacheSerializer;

  private ProductSerializer $engineSerializer;

  public function __construct(Meow $cluster, Cache $cache, ProductSerializer $engineSerializer, ProductSerializer $cacheSerializer) {
    $this->cluster          = $cluster;
    $this->cache            = $cache;
    $this->cacheSerializer  = $cacheSerializer;
    $this->engineSerializer = $engineSerializer;
  }

  public function getById(int $id): ?Product {
    if ($this->cache->has('product_' . $id)) {
      $product = $this->cacheSerializer->deserialize($this->cache->get('product_' . $id));
      return $product;
    }

    $raw_product = $this->query(['id' => $id]);
    if (!$raw_product) {
      return null;
    }

    $product = $this->engineSerializer->deserialize($raw_product);

    $this->cache->set('product_' . $id, $this->cacheSerializer->serialize($product), null, null);

    return $product;
  }

  private function query(array $criteria) {
    return null;
  }
}
