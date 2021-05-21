<?php

namespace Services;

use Cluster\Meow;

class OrdersService {

  private Meow $cluster;

  public function __construct(Meow $cluster) {
    $this->cluster = $cluster;
  }
}
