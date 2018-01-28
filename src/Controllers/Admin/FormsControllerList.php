<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/27/2018
 * Time: 2:17 AM
 */

namespace IB\Controllers\Admin;


use IB\Common\Views;
use IB\Controllers\Interfaces\ControllerInterface;
use IB\Modules\Forms\FormsService;
use IB\Modules\Pages\PageGenerator;
use Slim\Http\Request;
use Slim\Http\Response;

class FormsControllerList implements ControllerInterface
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
	 * @return Response|int
	 * @throws \IB\Common\ViewsException
	 */
	public function indexAction( Request $request, Response $response, array $args = [] )
	{
		$filter = '';
		if ( isset($args[ 'filter' ]) )
			$filter = $args[ 'filter' ];

		$forms = FormsService::getInstance()->getFormsByFilter( $filter );

		//var_dump($forms);
		$this->page->withContent( Views::loadView( 'common/list_of_forms.php', [ 'forms' => $forms ] ) );

		return $response->getBody()->write( $this->page->getMarkupContent( false ) );

	}
}