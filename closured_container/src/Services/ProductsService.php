<?php

namespace Services;

use Objects\Product;
use Storages\ProductsStorage;

class ProductsService {

  private ProductsStorage $storage;

  public function __construct(ProductsStorage $storage) {
    $this->storage = $storage;
  }

  public function getProductById(int $id): ?Product {
    return $this->storage->getById($id);
  }
}
