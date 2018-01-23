<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/22/2018
 * Time: 9:07 PM
 */

namespace IB\Controllers;


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


		$content = [
			'results'=> QueryBuild::select('states')->fields('id, name as text')->whereEqual('country_id', $args['country'])->execute()
		];

		$response = (new Response())->withJson($content);

		return $response;

	}

	private function makeDataForSelect2( array $itemsArray = [], $withPagination = false )
	{

	}

}