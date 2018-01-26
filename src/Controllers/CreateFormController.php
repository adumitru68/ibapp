<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/26/2018
 * Time: 2:23 PM
 */

namespace IB\Controllers;


use IB\Controllers\Interfaces\ControllerInterface;
use IB\Html\HtmlDiv;
use IB\Modules\Pages\PageGenerator;
use Slim\Http\Request;
use Slim\Http\Response;

class CreateFormController implements ControllerInterface
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
				->withHtmlElement(
					(new HtmlDiv())
						->withClass('row')
						->withHtmlElement(
							(new HtmlDiv())
								->withClass('col-sm-3')
						)
						->withHtmlElement(
							(new HtmlDiv())
								->withClass('col-sm-9')
								->withViewContent('pages/new_form.php', [])
						)
				)
				//->withViewContent('pages/admin.php',[])
		;

		$this->page
			->withPageTitle( 'Register page' )
			->withContent( $content )
			->withCssFile( '/css/custom.css' );
	}
}