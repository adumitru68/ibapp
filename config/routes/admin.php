<?php

use IB\Controllers\Admin\FormsController;
use IB\Controllers\Admin\FormsControllerList;
use IB\Controllers\Admin\FormsCreateController;
use IB\Controllers\AdminController;
use Interop\Container\ContainerInterface;
use Slim\App;

return function( App $app, ContainerInterface $container ) {

	$app->get('/admin/', AdminController::class . ':indexAction');
	$app->map( [ 'GET', 'POST' ], '/admin/forms/', FormsController::class . ':indexAction' );

	$app->group('/admin/ajax', function () use ($app) {
		$app->map( [ 'GET', 'POST' ], '/forms/new/', FormsCreateController::class . ':indexAction' );
		$app->map( [ 'GET', 'POST' ], '/forms/list/[{filter:[a-z0-9A-Z_- .]+}/]', FormsControllerList::class . ':indexAction' );
	});

	$app->add( new \Qpdb\SlimApplication\Middleware\TrailingSlash( true ) );
	$app->add( \Qpdb\SlimApplication\Middleware\RouteValidation::class );
	//$app->add( \IB\Controllers\Middleware\AdminMiddleware::class );

};