<?php

namespace Services;


use Storages\ProductStorage;

class ProductService {

  private ProductStorage $productStorage;

  public function __construct(ProductStorage $productStorage) {
    $this->productStorage = $productStorage;
  }

  public function getProduct(int $product_id): array {
    return $this->productStorage->getProductById($product_id);
  }
}