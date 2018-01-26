<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/26/2018
 * Time: 2:30 AM
 */

namespace IB\Controllers;


use IB\Controllers\Interfaces\ControllerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class UserFormsController implements ControllerInterface
{


	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 * @return Response
	 */
	public function indexAction( Request $request, Response $response, array $args = [] )
	{
		$content = '<H1>User Forms</H1>';

		$response->getBody()->write( $content );

		return $response;
	}
}