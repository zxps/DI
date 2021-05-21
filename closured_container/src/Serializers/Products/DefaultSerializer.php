<?php

namespace Serializers\Products;

use Objects\Product;
use Serializers\Product\ProductSerializer;

class DefaultSerializer implements ProductSerializer {

  public function serialize(Product $product): array {
    return [
      'id'   => $product->getId(),
      'name' => $product->getName(),
    ];
  }

  public function deserialize($raw): Product {
    $product = new Product((int)$raw['id']);
    if (isset($raw['name'])) {
      $product->setName((string)$raw['name']);
    }

    return $product;
  }
}