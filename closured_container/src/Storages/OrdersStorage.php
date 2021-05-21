<?php

namespace Storages;

use Cluster\Meow;
use Objects\Order;

class OrdersStorage {

  private Meow $cluster;

  private CacheStorage $cache;

  public function __construct(Meow $cluster, CacheStorage $cache) {
    $this->cluster = $cluster;
    $this->cache   = $cache;
  }

  public function getById(int $id): ?Order {
    return null;
  }

  public function save(Order $order): int {
    return 0;
  }

}
