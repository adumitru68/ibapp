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
use IB\Html\HtmlDiv;
use IB\Modules\Pages\PageGenerator;
use Slim\Http\Request;
use Slim\Http\Response;

class HomeController implements ControllerInterface
{

	/**
	 * @var PageGenerator
	 */
	private $page;

	/**
	 * RegisterController constructor.
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
	 * @throws ViewsException
	 */
	public function indexAction( Request $request, Response $response, array $args = [] )
	{

		$this->drawContent();

		return $response->getBody()->write( $this->page->getMarkupContent() );

	}

	private function drawContent()
	{
		$content =
			( new HtmlDiv() )
				->withClass( 'fluid-container' )
				->withViewContent('common/navigation.php',[])
				->withViewContent('pages/home.php',[])
				;

		$this->page
			->withPageTitle( 'Register page' )
			->withContent( $content )
			->withCssFile( '/css/custom.css' );
	}

}

