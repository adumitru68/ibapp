<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/21/2018
 * Time: 5:45 AM
 */

namespace IB\Controllers\Interfaces;


use Slim\Http\Request;
use Slim\Http\Response;

interface ControllerInterface
{

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 * @return Response
	 */
	public function indexAction( Request $request, Response $response, array $args = [] );

}