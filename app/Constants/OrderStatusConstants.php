<?php

namespace App\Constants;

class OrderStatusConstants
{
    const ORDER_STATUS_NO = [
        'Canceled' => -1,
        'Back To Sender' => -2,
        'Pending' => 10,
        'Awaiting Pickup By Driver' => 20,
        'On Route To Deliver' => 50,
        'Delivered' => 100,
        'Completed' => 100
    ];
}
