<?php

namespace DI\Bundles\Common;

use DI\Parameters;

class Configuration implements \DI\Configuration {
  public const KEY_MEOW_ACTOR = 'meow_actor';

  private Parameters $parameters;

  public function __construct(array $parameters) {
    $this->parameters = new Parameters($parameters);
  }

  public function getName(): string {
    return 'common';
  }

  public function getParameters(): Parameters {
    return $this->parameters;
  }
}
