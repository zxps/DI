<?php

namespace Serializers\Product;

use Objects\Product;

interface ProductSerializer {

  public function serialize(Product $product): array;

  public function deserialize($raw): Product;
}
