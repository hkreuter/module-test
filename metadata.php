<?php

/**
 * Copyright © Fake IT. All rights reserved.
 * See LICENSE file for license details.
 */

/**
 * Metadata version
 */
$sMetadataVersion = '2.1';

/**
 * Module information
 */
$aModule = [
    'id'          => 'hkr_moduletest',
    'title'       => 'CHANGE MY TITLE',
    'description' =>  '',
    'thumbnail'   => 'out/pictures/logo.png',
    'version'     => '0.0.1',
    'author'      => 'Fake IT',
    'url'         => '',
    'email'       => '',
    'extend'      => [
        \OxidEsales\Eshop\Application\Model\User::class => \HkReuter\ModuleTest\Model\User::class,
        \OxidEsales\Eshop\Application\Controller\StartController::class => \HkReuter\ModuleTest\Controller\StartController::class
    ],
    'controllers' => [
        'oetmgreeting' => \HkReuter\ModuleTest\Controller\GreetingController::class
    ],
    'templates'   => [
        'greetingtemplate.tpl' => 'hkr/moduletest/views/templates/greetingtemplate.tpl',
    ],
    'events' => [
        'onActivate' => '\HkReuter\ModuleTest\Core\ModuleEvents::onActivate',
        'onDeactivate' => '\HkReuter\ModuleTest\Core\ModuleEvents::onDeactivate'
    ],
    'blocks'      => [
        [
            //It is possible to replace blocks by theme, to do so add 'theme' => '<theme_name>' key/value in here
            'template' => 'page/shop/start.tpl',
            'block' => 'start_welcome_text',
            'file' => 'views/blocks/oetm_start_welcome_text.tpl'
        ]
    ],
    'settings' => [
        /** Main */
        [
            'group'       => 'oemoduletemplate_main',
            'name'        => 'oemoduletemplate_GreetingMode',
            'type'        => 'select',
            'constraints' => 'generic|personal',
            'value'       => 'generic'
        ],
    ],
];
