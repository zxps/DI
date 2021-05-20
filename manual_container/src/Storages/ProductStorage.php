<?php

namespace Storages;

class ProductStorage {

  private string $cluster;

  public function __construct(string $cluster) {
    $this->cluster = $cluster;
  }

  public function getProductById(int $product_id): array {
    return [
      'id'   => $product_id,
      'name' => 'Toyota Crown 1998',
    ];
  }
}