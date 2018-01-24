<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/22/2018
 * Time: 9:07 PM
 */

namespace IB\Controllers;


use Qpdb\QueryBuilder\DB\DbService;
use Qpdb\QueryBuilder\QueryBuild;
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
			'results'=> QueryBuild::select('countries')->fields('id, name as text')->execute()
		];

		$response = (new Response())->withJson($content);

		return $response;
	}


	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 * @return Response|static
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function citiesAction ( Request $request, Response $response, array $args = [] )
	{

		$sql = "select cities.id, cities.name as text from cities 
				inner join states on cities.state_id = states.id
				inner join countries on states.country_id = countries.id
				where countries.id=?";

		$content = [
			'results'=> DbService::getInstance()->query($sql, [$args['country']])
		];

		//var_dump($content);

		$response = (new Response())->withJson($content);

		return $response;

	}

	private function makeDataForSelect2( array $itemsArray = [], $withPagination = false )
	{

	}

}