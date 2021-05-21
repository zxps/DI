<?php

namespace Storages;

use Cache\Cache;

class CacheStorage implements Cache {

  private int $actor;

  public function __construct(int $actor) {
    $this->actor = $actor;
  }

  public function get(string $key, $default = null) {
    // TODO: Implement get() method.
  }

  public function set(string $key, $value, ?int $flags, int $expire) {
    // TODO: Implement set() method.
  }

  public function has(string $key): bool {
    // TODO: Implement has() method.
  }
}