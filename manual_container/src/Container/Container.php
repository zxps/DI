<?php

namespace Container;


use Container\Bundles\YoulaBundle;
use Container\Bundles\YoulaConfiguration;
use Services\ProductService;
use Storages\ProductStorage;

abstract class Container {

  /** @var Container[] */
  private static $bundles = [];

  private Configuration $configuration;

  protected ProductService $productService;
  protected ProductStorage $productStorage;

  private function __construct(Configuration $configuration) {
    $this->configuration = $configuration;
    $this->inject($configuration->getParameters());
  }

  abstract protected function inject(Parameters $parameters): void;

  final public function getConfiguration(): Configuration {
    return $this->configuration;
  }

  /** <Injected service getters> */
  final public function getProductService(): ProductService {
    return $this->productService;
  }

  /** <Injected service getters/> */

  final public static function get(string $name): Container {
    if (isset(self::$bundles[$name])) {
      return self::$bundles[$name];
    }

    $bundle = null;
    switch ($name) {
      case 'youla':
        $bundle = new YoulaBundle(new YoulaConfiguration());
        break;
    }

    if (!$bundle) {
      throw new BundleNotExistsException('Bundle ' . $name . ' not exists');
    }

    self::$bundles[$name] = $bundle;

    return $bundle;
  }
}