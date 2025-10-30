<?php

use Pest\PluginInterface;

return [
    'suites' => [
        'default' => [
            'path' => 'tests',
            'uses' => [
                Tests\TestCase::class,
            ],
        ],
    ],
];