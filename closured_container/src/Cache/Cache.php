<?php
namespace Cache;

interface Cache {
  public function get(string $key, $default = null);

  public function set(string $key, $value, ?int $flags, int $expire);

  public function has(string $key): bool;
}