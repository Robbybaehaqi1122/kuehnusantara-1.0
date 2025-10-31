<?php

return [
    'duitku_gateway' => [
        'code'        => 'duitku_gateway',
        'name'        => 'Duitku Payment Gateway',
        'description' => 'Pembayaran online melalui Duitku (Virtual Account, eWallet, dsb)',
        'class'       => Webkul\Duitku\Payment\Duitku::class,
        'active'      => true,
    ],
];
