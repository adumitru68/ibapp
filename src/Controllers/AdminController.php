<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/23/2018
 * Time: 4:34 AM
 */

namespace IB\Controllers;


use IB\Html\HtmlDiv;
use IB\Modules\Pages\PageGenerator;
use IB\Modules\Users\UserContext;
use Slim\Http\Request;
use Slim\Http\Response;

class AdminController
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
	 * @throws \IB\Common\ViewsException
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
				->withViewContent('pages/admin.php',[])
		;

		$this->page
			->withPageTitle( 'Register page' )
			->withContent( $content )
			->withCssFile( '/css/custom.css' )
			->withJsFile( '/js/register.js' );
	}

}