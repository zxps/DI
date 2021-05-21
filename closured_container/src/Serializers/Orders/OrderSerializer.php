<?php

namespace Serializers\Orders;

use Objects\Order;

interface OrderSerializer {

  public function deserialize($raw): Order;

  public function serialize(Order $order): array;
}
