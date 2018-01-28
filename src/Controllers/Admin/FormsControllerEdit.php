<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/28/2018
 * Time: 4:36 PM
 */

namespace IB\Controllers\Admin;


use IB\Common\Views;
use IB\Controllers\Interfaces\ControllerInterface;
use IB\Modules\Forms\FormsService;
use IB\Modules\Forms\FormsServiceDao;
use IB\Modules\Pages\PageGenerator;
use Slim\Http\Request;
use Slim\Http\Response;

class FormsControllerEdit implements ControllerInterface
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
		$dao = FormsServiceDao::getInstance()->getFormById( $request->getParam('form_id') );
		$this->page->withContent( Views::loadView( 'common/edit_form.php', [ 'dao' => $dao ] ) );

		return $response->getBody()->write( $this->page->getMarkupContent( false ) );
	}
}