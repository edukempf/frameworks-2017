<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

use Zend\Session\Storage\SessionArrayStorage;
use Zend\Session\Validator\RemoteAddr;
use Zend\Session\Validator\HttpUserAgent;

return [
    'service_manager' => [
        'factories' => [
            Application\Model\BeerTableGateway::class =>  Application\Factory\BeerTableGateway::class,
            Application\Model\UserTableGateway::class =>  Application\Factory\UserTableGateway::class,
            Application\Factory\DbAdapter::class => Application\Factory\DbAdapter::class,
            //'Application\Service\Cache' => Application\Factory\Service\Cache::class,
            \Zend\Authentication\AuthenticationService::class => Service\Factory\AuthenticationServiceFactory::class,
        ],
    ],
    'db' => [
        'driver' => 'Pdo_Sqlite',
        'database' => 'data/beers.db',
    ],
    /*'cache' => [
        'adapter' => [
            'name'    => 'apc',
            'options' => ['ttl' => 3600],
        ],
        'plugins' => [
            'exception_handler' => ['throw_exceptions' => false],
            'serializer',
        ],
    ],*/
    'session_config' => [
        'cookie_lifetime' => 60*60*1,     
        'gc_maxlifetime'     => 60*60*24*30, 
    ],
    'session_manager' => [
        'validators' => [
            RemoteAddr::class,
            HttpUserAgent::class,
        ]
    ],
    'session_storage' => [
        'type' => SessionArrayStorage::class
    ],
];
