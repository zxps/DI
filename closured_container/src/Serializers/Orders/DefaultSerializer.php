<?php

namespace Serializers\Orders;

use Objects\Order;

class DefaultSerializer implements OrderSerializer {

  public function __construct() {

  }

  public function deserialize($order): Order {
    return new Order((int)$order['id']);
  }

  public function serialize(Order $order): array {
    return [
      'id' => $order->getId(),
    ];
  }
}
