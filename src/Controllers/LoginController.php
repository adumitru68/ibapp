<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/25/2018
 * Time: 1:12 PM
 */

namespace IB\Controllers;


use IB\Controllers\Interfaces\ControllerInterface;
use IB\Html\HtmlDiv;
use IB\Modules\Pages\PageGenerator;
use Slim\Http\Request;
use Slim\Http\Response;

class LoginController implements ControllerInterface
{

	/**
	 * @var PageGenerator
	 */
	private $page;

	/**
	 * LoginController constructor.
	 */
	public function __construct()
	{
		$this->page = new PageGenerator();
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 * @return int|Response
	 * @throws \IB\Common\ViewsException
	 */
	public function indexAction( Request $request, Response $response, array $args = [] )
	{
		$this->drawContent(
			empty($request->getParsedBody()) ?[] :$request->getParsedBody()
		);

		return $response->getBody()->write( $this->page->getMarkupContent() );
	}

	private function drawContent( $data = [])
	{
		$content =
			( new HtmlDiv() )
				->withClass( 'container' )
				->withStyle( 'max-width', '450px' )
				->withStyle( 'margin-top', '30px' )
				->withViewContent( 'pages/login.php', $data )
				->withHtmlElement(
					( new HtmlDiv() )
						->withId( 'result_submit' )
						->withClass('row')
				);

		$this->page
			->withPageTitle( 'Register page' )
			->withContent( $content )
			->withCssFile( '/css/custom.css' );
	}
}