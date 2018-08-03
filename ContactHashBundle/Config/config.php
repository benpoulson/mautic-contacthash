<?php


return [
    'name'        => 'ContactHash',
    'description' => 'A Mautic plugin to automatically update add a hash to a contact based on their email',
    'version'     => '1.0',
    'author'      => 'Ben Poulson',

    'services' => [
        'events' => [
            'mautic.plugin.instantsegments.subscriber' => [
                'class'     => MauticPlugin\InstantSegmentsBundle\EventListener\ContactListener::class,
                'arguments' => [
                    'mautic.helper.integration',
                ],
            ],
        ],
    ],

    'integrations' => [
        'mautic.integration.instantsegments' => [
            'class'     => \MauticPlugin\InstantSegmentsBundle\Integration\ContactHashIntegration::class,
            'arguments' => [
                'mautic.helper.integration', 'service_container'
            ],
        ],
    ],
];
