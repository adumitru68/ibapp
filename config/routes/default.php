<?php

use IB\Controllers\HomeController;
use IB\Controllers\LoginController;
use IB\Controllers\MakeAdminController;
use IB\Controllers\RegisterController;
use IB\Controllers\UserFormsController;
use Interop\Container\ContainerInterface;
use Slim\App;

return function( App $app, ContainerInterface $container ) {


	$app->get( '/', HomeController::class . ':indexAction' );
	$app->map( [ 'GET', 'POST' ], '/register/', RegisterController::class . ':indexAction' );
	$app->map( [ 'GET', 'POST' ], '/login/', LoginController::class . ':indexAction' );
	$app->map( [ 'GET', 'POST' ], '/logout/', LoginController::class . ':logOut' );
	$app->map( [ 'GET', 'POST' ], '/temp/action/make-admin/', MakeAdminController::class . ':indexAction' );

	$app->group('/user', function () use ($app) {
		$app->map( [ 'GET', 'POST' ], '/forms/', UserFormsController::class . ':indexAction' );
		$app->map( [ 'GET', 'POST' ], '/account/', UserFormsController::class . ':indexAction' );
	});

	$app->add( new \Qpdb\SlimApplication\Middleware\TrailingSlash( true ) );
	$app->add( \Qpdb\SlimApplication\Middleware\RouteValidation::class );


};