<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/22/2018
 * Time: 9:07 PM
 */

namespace IB\Controllers;


use IB\Modules\Locations\LocationService;
use Slim\Http\Request;
use Slim\Http\Response;

class ApiControllers
{

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 * @return Response
	 * @throws ViewsException
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function countriesAction( Request $request, Response $response, array $args = [] )
	{

		$content = [
			'results' => LocationService::getInstance()->getCountries()
		];

		return ( new Response() )->withJson( $content );

	}


	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 * @return Response|static
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function citiesAction( Request $request, Response $response, array $args = [] )
	{

		$content = [
			'results' => LocationService::getInstance()->getCitiesByCountryId( $args[ 'country' ] )
		];

		return ( new Response() )->withJson( $content );

	}

}