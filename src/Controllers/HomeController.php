<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/21/2018
 * Time: 11:50 AM
 */

namespace IB\Controllers;


use IB\Common\Views;
use IB\Common\ViewsException;
use IB\Controllers\Interfaces\ControllerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class HomeController implements ControllerInterface
{

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 * @return Response
	 * @throws ViewsException
	 */
	public function indexAction( Request $request, Response $response, array $args = [] )
	{
		$content = '<H1>Home page</H1><br><a href="/register/">Register</a>';
		var_dump($_SESSION);
		$response->getBody()->write( $content );
		var_dump((bool)null);
		var_dump((string)null);

		return $response;
	}
}