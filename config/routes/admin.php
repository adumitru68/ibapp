<?php

use IB\Controllers\AdminController;
use Interop\Container\ContainerInterface;
use Slim\App;

return function( App $app, ContainerInterface $container ) {

	$app->map( [ 'GET', 'POST' ], '/admin/', AdminController::class . ':indexAction' );

	$app->add( new \Qpdb\SlimApplication\Middleware\TrailingSlash( true ) );
	$app->add( \Qpdb\SlimApplication\Middleware\RouteValidation::class );
	$app->add( \IB\Controllers\Middleware\AdminMiddleware::class );

};