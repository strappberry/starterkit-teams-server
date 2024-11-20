<?php

return [
    'subscriptions_enabled' => env('STRIPE_SUBSCRIPTIONS_ENABLED', false),

    'subscriptions' => [
        'basic' => [
            'id' => env('STRIPE_SUBSCRIPTION_BASIC', ''),
            'price_month_id' => env('STRIPE_SUBSCRIPTION_BASIC_PRICE', ''),
            'price_anual_id' => env('STRIPE_SUBSCRIPTION_BASIC_PRICE', ''),
            'name' => 'Basic',
            'display_price' => '$1,099.00',
            'features' => [
                'feature 1',
                'feature 2',
                'feature 3',
            ],
        ],
    ],
];
