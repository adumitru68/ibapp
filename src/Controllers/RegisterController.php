<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/22/2018
 * Time: 10:43 PM
 */

namespace IB\Controllers;


use IB\Common\HelperIb;
use IB\Common\ViewsException;
use IB\Controllers\Interfaces\ControllerInterface;
use IB\Html\HtmlDiv;
use IB\Modules\Pages\PageGenerator;
use IB\Modules\Users\UserService;
use IB\Modules\Validation\DataValidation;
use IB\Modules\Validation\FormValidator;
use Qpdb\QueryBuilder\DB\DbConnect;
use Qpdb\QueryBuilder\DB\DbService;
use Qpdb\QueryBuilder\QueryBuild;
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
	 * @var FormValidator
	 */
	private $formValidator;


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

		if ( $request->getMethod() == SlimAppConst::METHOD_POST ) {
			$this->formValidator = new FormValidator();
			$this->processedForm( $request->getParsedBody() );

			if ( !count( $this->formValidator->getFormErrors() ) ) {
				$this->createUser();
			}

			return ( new Response() )->withJson( $this->formValidator->getFormErrors() );
		}

		$this->drawContent();

		return $response->getBody()->write( $this->page->getMarkupContent() );

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
					( new HtmlDiv() )
						->withId( 'result_submit' )
						//->withStyle('display','block')
						->withClass( 'clearfix' )
				);

		$this->page
			->withPageTitle( 'Register page' )
			->withContent( $content )
			->withCssFile( '/css/custom.css' )
			->withJsFile( '/js/register.js' );
	}

	private function createUser()
	{
		$this->prepareFormData();
		if ( UserService::getInstance()->createUser( $this->formValidator->getFormDao() ) )
			$this->updateUserJwt();
		else
			$this->formValidator->addError( 'user_email', 'This email already exists' );
	}

	private function updateUserJwt()
	{
		$lastId = DbConnect::getInstance()->lastInsertId();
		$jwt = HelperIb::JwtEncode(
			[
				'user_id' => DbService::getInstance()->lastInsertId(),
				'user_email' => $this->formValidator->getFormDao()['user_email'],
				'user_admin' => 0,
			]
		);
		QueryBuild::update('users')->setField('user_token', $jwt)->whereEqual('user_id',$lastId)->limit(1)->execute();
	}

	private function prepareFormData()
	{
		$hashPass = HelperIb::passwordHash( $this->formValidator->getDataValue( 'user_pass' ) );
		$this->formValidator->editData( 'user_pass', $hashPass );
	}

	private function processedForm( array $data )
	{

		$this->formValidator
			->withFieldValidation(
				'user_name',
				( new DataValidation( $data[ 'user_name' ] ) )
					->notEmpty( 'Full name field is required' )
			)
			->withFieldValidation(
				'user_email',
				( new DataValidation( $data[ 'user_email' ] ) )
					->notEmpty( 'The email field is required' )
					->isEmail( 'Invalid email address' )
			)
			->withFieldValidation(
				'user_pass',
				( new DataValidation( trim( $data[ 'user_pass' ] ) ) )
					->notEmpty( 'Please type password' )
					->isValidPassword( trim( $data[ 'user_pass2' ] ), 'Invalid password' )
			)
			->withFieldValidation(
				'user_prof',
				( new DataValidation( $data[ 'user_prof' ] ) )
					->notEmpty( 'The profession field is required' )
			)
			->withFieldValidation(
				'user_dob',
				( new DataValidation( $data[ 'user_dob' ] ) )
					->notEmpty( 'Birthday field is required' )
					->isDate( 'Y-m-d', 'Invalid date' )
			)
			->withFieldValidation(
				'user_country',
				( new DataValidation( (int)$data[ 'user_country' ] ) )
					->notZero( 'Please select the country' )
			)
			->withFieldValidation(
				'user_city',
				( new DataValidation( (int)$data[ 'user_city' ] ) )
					->notZero( 'Please select the city' )
			)
			->withFieldValidation(
				'user_street',
				( new DataValidation( $data[ 'user_street' ] ) )
			);

	}

}