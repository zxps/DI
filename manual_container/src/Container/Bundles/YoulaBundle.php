<?php

namespace Container\Bundles;

use Container\Container;
use Container\Parameters;
use Services\ProductService;
use Storages\ProductStorage;

class YoulaBundle extends Container {

  public function inject(Parameters $parameters): void {
    $productStorage = new ProductStorage($parameters->get('cluster'));

    $this->productService = new ProductService($this->productStorage);
  }
}