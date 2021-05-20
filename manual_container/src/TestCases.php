<?php

class TestCases {

  public static function main() {

    $product = \Container\Container::get('youla')->getProductService()->getProduct(1000);
  }
}