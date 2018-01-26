<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/26/2018
 * Time: 12:08 AM
 */

namespace IB\Controllers\Middleware;


use IB\Modules\Users\UserContext;
use Qpdb\SlimApplication\Middleware\Middleware;
use Slim\Exception\NotFoundException;
use Slim\Http\Response;

class AdminMiddleware extends Middleware
{

	protected function before()
	{
		if ( !UserContext::isAdmin() ) {
			$this->response = ( new Response() )->withRedirect( '/login/' );
			//throw new NotFoundException( $this->request, $this->response );
		}
	}
}