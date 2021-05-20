<?php

namespace Container\Bundles;

use Container\Configuration;
use Container\Container;

class YoulaConfiguration implements Configuration {

  public function getName(): string {
    return 'youla';
  }

  public function configure(Container $container): void {

  }
}