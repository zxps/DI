<?php

namespace DI;

class DI {
  private const BUNDLE_COMMON = 'common';

  private static array $bundles = [];

  public static function get(string $bundle) {
    switch ($bundle) {
      case self::BUNDLE_COMMON:
        if (isset($bundles[self::BUNDLE_COMMON])) {
          /** @var Bundles\Common\Container $bundle */
          $bundle = $bundles[self::BUNDLE_COMMON];
          return $bundle;
        }

        $bundle = new Bundles\Common\Common(['meow_actor' => 'awesome_meow_actor_id',]);;;

        self::$bundles['common'] = $bundle;

        return $bundle;
        break;
    }

    throw new Exception('Bundle "' . $bundle . '" not exists');
  }

  public static function common(): Bundles\Common\Container {
    /** @var Bundles\Common\Container $bundle */
    $bundle = self::get(self::BUNDLE_COMMON);
    return $bundle;
  }
}