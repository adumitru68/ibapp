<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/28/2018
 * Time: 6:37 AM
 */

namespace IB\Controllers\Admin;


use IB\Controllers\Interfaces\ControllerInterface;
use IB\Modules\Forms\FormsService;
use IB\Modules\Validation\DataValidation;
use IB\Modules\Validation\FormValidator;
use Qpdb\QueryBuilder\DB\DbConnect;
use Slim\Http\Request;
use Slim\Http\Response;

class FormsCreateController implements ControllerInterface
{

	/**
	 * @var FormValidator
	 */
	private $formValidator;

	/**
	 * @var int
	 */
	private $lastId;


	/**
	 * FormsCreateController constructor.
	 */
	public function __construct()
	{
		$this->formValidator = new FormValidator();
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 * @return Response
	 */
	public function indexAction( Request $request, Response $response, array $args = [] )
	{
		$responseArray = [
			'errors' => [],
			'lastId' => 0
		];
		$this->processedForm($request->getParsedBody());
		if ( !count( $this->formValidator->getFormErrors() ) ) {
			$this->createForm();
			$responseArray['lastId'] = $this->lastId;
		}
		$responseArray['errors'] = $this->formValidator->getFormErrors();

		return ( new Response() )->withJson( $responseArray );
	}

	private function processedForm( array $data )
	{
		$this->formValidator
			->withFieldValidation(
				'form_name',
				( new DataValidation( $data[ 'form_name' ] ) )
					->notEmpty( 'Form title is required' ),
				'form_name_new'
			);
	}

	private function createForm()
	{
		FormsService::getInstance()->createForm($this->formValidator->getFormDao());
		$this->lastId = (int)DbConnect::getInstance()->lastInsertId();
	}

}