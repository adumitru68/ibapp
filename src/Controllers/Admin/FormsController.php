<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/27/2018
 * Time: 1:59 AM
 */

namespace IB\Controllers\Admin;


use IB\Controllers\Interfaces\ControllerInterface;
use IB\Html\HtmlDiv;
use IB\Modules\Pages\PageGenerator;
use Slim\Http\Request;
use Slim\Http\Response;

class FormsController implements ControllerInterface
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
	 * @return Response
	 * @throws \IB\Common\ViewsException
	 */
	public function indexAction( Request $request, Response $response, array $args = [] )
	{
		$this->drawContent();

		$response->getBody()->write( $this->page->getMarkupContent() );

		return $response;
	}

	private function drawContent()
	{
		$leftContent = (new HtmlDiv())
			->withClass('col-sm-4 pr-0 mr-0')
			->withViewContent('pages/admin_forms_left.php',[])
		;

		$rightComtent = ( new HtmlDiv())
			->withClass('col-sm-8 pl-0 ml-0')
			->withViewContent('pages/new_form.php',[])
		;

		$content =
			( new HtmlDiv() )
				->withClass( 'fluid-container' )
				->withViewContent('common/navigation.php',[])
				->withHtmlElement(
					(new HtmlDiv())
						->withClass('row')
						->withHtmlElement($leftContent)
						->withHtmlElement($rightComtent)
				)
				;

		$this->page
			->withPageTitle( 'Forms management' )
			->withContent( $content )
			->withCssFile( '/css/custom.css' )
			->withJsFile('/js/forms-mn.js')
		;
	}
}