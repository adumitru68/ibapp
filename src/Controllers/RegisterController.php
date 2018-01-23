<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/22/2018
 * Time: 10:43 PM
 */

namespace IB\Controllers;


use IB\Controllers\Interfaces\ControllerInterface;
use IB\Html\HtmlDiv;
use IB\Modules\Pages\PageGenerator;
use Qpdb\SlimApplication\Utils\SlimAppConst;
use Slim\Http\Request;
use Slim\Http\Response;

class RegisterController implements ControllerInterface
{

	/**
	 * @var PageGenerator
	 */
	private $page;

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 * @return Response
	 * @throws \IB\Common\ViewsException
	 */
	public function indexAction( Request $request, Response $response, array $args = [] )
	{
		$this->page = new PageGenerator();

		if ( $request->getMethod() == SlimAppConst::METHOD_POST ) {
			$this->saveUser( $request->getParsedBody() );
			$loadDocument = false;
		} else {
			$this->createContent();
			$loadDocument = true;
		}

		$response->getBody()->write( $this->page->getMarkupContent( $loadDocument ) );

		return $response;
	}

	private function createContent()
	{
		$content =
			( new HtmlDiv() )
				->withClass( 'container' )
				->withStyle( 'max-width', '500px' )
				->withStyle( 'margin-top', '30px' )
				->withViewContent( 'pages/register.php', [] );

		$this->page
			->withContent( $content )
			->withJsFile( '/js/register.js' );
	}

	private function saveUser( array $data )
	{
		//TODO implement
	}

	private function validateData( array $data )
	{
		//TODO implement
	}

}