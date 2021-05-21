<?php

namespace Objects;

class Product {

  private int $id;
  private string $name = '';

  public function __construct(int $id) {
    $this->id = $id;
  }

  public function getId(): int {
    return $this->id;
  }

  public function setName(string $name): void {
    $this->name = $name;
  }

  public function getName(): string {
    return $this->name;
  }
}
