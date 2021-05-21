<?php

namespace DI;

class Parameters {

  private array $parameters;

  public function __construct(array $parameters) {
    $this->parameters = $parameters;
  }

  public function get(string $key, $defaultValue = null) {
    return $this->parameters[$key] ?? $defaultValue;
  }
}