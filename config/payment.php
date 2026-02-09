<?php

return [

    'stripe' => [
        'client' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),
        'callback' => 'stripe/webhook',
        'events' => [
            'charge.succeeded',
            'charge.failed',
            'invoice.paid',
            'invoice.payment_failed',
            'payment_intent.succeeded',
            'payment_intent.payment_failed',
            'coupon.created',
            'promotion_code.created',
        ],
    ],
    'currency' => 'usd',
    'currency_icon' => '$',
];
