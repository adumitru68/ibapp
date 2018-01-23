<?php

use IB\Controllers\ApiControllers;
use Interop\Container\ContainerInterface;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function( App $app, ContainerInterface $container ) {

	$app->map( ['GET','POST'],'/api/location/countries/', ApiControllers::class.':countriesAction');
	$app->map( ['GET','POST'],'/api/location/cities/{country:[0-9]+}/', ApiControllers::class.':citiesAction');
	$app->options( '/{routes:.+}', function( Request $request, Response $response, $args ) {
		return $response;
	} );
	$this->app->add( \Qpdb\SlimApplication\Middleware\RouteValidation::class );

};