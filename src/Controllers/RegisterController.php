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
			$this->processedForm( $request->getParsedBody() );
			$loadDocument = false;
		}
		else {
			$this->drawContent();
			$loadDocument = true;
		}

		$response->getBody()->write( $this->page->getMarkupContent( $loadDocument ) );

		return $response;
	}

	private function drawContent()
	{
		$content =
			( new HtmlDiv() )
				->withClass( 'container' )
				->withStyle( 'max-width', '600px' )
				->withStyle( 'margin-top', '30px' )
				->withViewContent( 'pages/register2.php', [] )
				->withHtmlElement(
					(new HtmlDiv())
						->withId('result_submit')
						->withClass('row')
				);

		$this->page
			->withContent( $content )
			->withCssFile( '/css/custom.css' )
			->withJsFile( '/js/register.js' );
	}

	private function processedForm( array $data )
	{
		//var_dump($data);
		$this->page->withContent("<script>$('#xemail').addClass('is-invalid')</script>");
	}

	private function validateData( array $data )
	{
		//TODO implement
	}

}