<?php

namespace DI;

abstract class AbstractContainer implements Container {

  /** @var mixed[] */
  private array $registered = [];

  /** @var mixed[] */
  private array $instances = [];

  public function __construct() {
    $this->configure();
  }

  abstract protected function configure();

  public function getConfiguration(): Configuration {
    // TODO: Implement getConfiguration() method.
  }

  protected function register(string $key, \Closure $initializator): void {
    $this->registered[$key] = $initializator;
  }

  protected function get(string $key) {
    if (isset($this->instances[$key])) {
      return $this->instances[$key];
    }

    $callable              = $this->registered[$key];
    $this->instances[$key] = $callable($this);

    return $this->instances[$key];
  }
}