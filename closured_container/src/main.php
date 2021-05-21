<?php


function main () {
  $product = \DI\DI::common()->getProductsService()->getProductById(1000);
  if ($product) {
    echo "Found product with id=" . $product->getName() . " and name=" . $product->getName();
  } else {
    echo "Product not found";
  }
}