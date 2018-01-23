<?php

use IB\Controllers\HomeController;
use IB\Controllers\RegisterController;
use Interop\Container\ContainerInterface;
use Slim\App;

return function( App $app, ContainerInterface $container ) {


	$app->get( '/', HomeController::class . ':indexAction' );
	$app->map( [ 'GET', 'POST' ], '/register/', RegisterController::class . ':indexAction' );

	$app->add( new \Qpdb\SlimApplication\Middleware\TrailingSlash( true ) );
	$app->add( \Qpdb\SlimApplication\Middleware\RouteValidation::class );


};