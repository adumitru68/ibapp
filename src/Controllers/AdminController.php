<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/23/2018
 * Time: 4:34 AM
 */

namespace IB\Controllers;


use Slim\Http\Request;
use Slim\Http\Response;

class AdminController
{

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 * @return Response
	 */
	public function indexAction( Request $request, Response $response, array $args = [] )
	{
		$content = '<H1>Admin</H1>';
		$response->getBody()->write( $content );

		return $response;
	}

}