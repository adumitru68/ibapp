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
		// TODO: Implement indexAction() method.

		$content = Views::loadView('common/page.php', ['test'=>'val test']);

		$response->getBody()->write( $content );

		return $response;
	}
}