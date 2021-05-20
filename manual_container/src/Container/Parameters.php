<?php

namespace Container;

class Parameters {

  private array $data;

  public function __construct(array $data) {
    $this->data = $data;
  }

  public function get(string $key) {
    return $this->data[$key];
  }

  public function has(string $key): bool {
    return true;
  }
}