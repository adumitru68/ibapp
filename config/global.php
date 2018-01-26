<?php

use IB\Common\HelperIb;
use Qpdb\SlimApplication\Router\RouterDetails;
use Qpdb\SlimApplication\Router\RouterService;
use Interop\Container\ContainerInterface;
use Slim\App;

const IB_ROUTER_API = 'apiRouter';
const IB_ROUTER_ADMIN = 'adminRouter';
const IB_ROUTER_DEFAULT = 'defaultRouter';

return [

	'use-routers' => [
		IB_ROUTER_API => '/api/',
		IB_ROUTER_ADMIN => '/admin/',
		IB_ROUTER_DEFAULT => '/'
	],

	'routes' => [
		IB_ROUTER_API => __DIR__ . '/routes/api.php',
		IB_ROUTER_ADMIN => __DIR__ . '/routes/admin.php',
		IB_ROUTER_DEFAULT => __DIR__ . '/routes/default.php'
	],

	'response-headers' => [

		IB_ROUTER_API => [
			'Content-Type' => 'application/json; charset=UTF-8'
		],

		IB_ROUTER_ADMIN => [
			'Content-Type' => 'text/html; charset=UTF-8'
		],

		IB_ROUTER_DEFAULT => [
			'Content-Type' => 'text/html; charset=UTF-8'
		]

	],

	'slim-settings' => [

		'settings' => [
			'httpVersion' => '1.1',
			'responseChunkSize' => 4096,
			'outputBuffering' => 'append',
			'determineRouteBeforeAppMiddleware' => true,
			'displayErrorDetails' => true,
			'addContentLengthHeader' => false,
			'routerCacheFile' => false,
			'php-di' => [
				'use_autowiring' => true,
				'use_annotations' => false,
			]
		],

		App::class => function( ContainerInterface $c ) {
			return new App( $c );
		},

		RouterService::class => function( ContainerInterface $c ) {
			return new RouterService( $c->get( App::class ), $c );
		},

		'notFoundHandler' => function() {
			return new \Qpdb\SlimApplication\Handlers\SlimAppNotFound( null );
		},

		'notAllowedHandler' => function() {
			return new \Qpdb\SlimApplication\Handlers\SlimAppNotAllowed( null );
		},

		'phpErrorHandler' => function( ContainerInterface $c ) {
			return new \Slim\Handlers\PhpError( $c->get( 'settings' )[ 'displayErrorDetails' ] );
		},

		'errorHandler' => function( ContainerInterface $c ) {
			return new \Slim\Handlers\Error( $c->get( 'settings' )[ 'displayErrorDetails' ] );
		},

		'routerType' => function() {
			return RouterDetails::getInstance()->getRouterType();
		},

	],

	'sessionCfg' => [
		'name' => 'IB_7I1Z64C0KH',
		'cookie' => [
			'lifetime' => 0,
			//'path' => ini_get('session.cookie_path'),
			'path' => '/',
			'domain' => '.' . HelperIb::getServerName(),
			'secure' => isset($_SERVER['HTTPS']),
			'httponly' => true
		],

	]
];