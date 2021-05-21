<?php

namespace DI\Bundles\Common;

use Services\OrdersService;
use Services\ProductsService;

interface Container extends \DI\Container {

  public function getProductsService(): ProductsService;

  public function getOrdersService(): OrdersService;
}