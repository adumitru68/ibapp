<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/26/2018
 * Time: 12:19 PM
 */

namespace IB\Controllers;


use IB\Common\HelperIb;
use IB\Controllers\Interfaces\ControllerInterface;
use IB\Html\HtmlDiv;
use IB\Modules\Pages\PageGenerator;
use IB\Modules\Users\UserModel;
use IB\Modules\Users\UserService;
use Qpdb\SlimApplication\Utils\SlimAppConst;
use Slim\Http\Request;
use Slim\Http\Response;

class MakeAdminController implements ControllerInterface
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

		$data=[];

		if($request->getMethod() == SlimAppConst::METHOD_POST){
			$data = $request->getParsedBody();
			$error = $this->makeAdmin($data['user_email']);
			if($error)
				$msg = ['messageType'=>'alert-danger', 'message'=>'User not found'];
			else
				$msg = ['messageType'=>'alert-success', 'message'=>'User is now admin!'];
			$data['msg'] = $msg;
		}

		$this->drawContent( $data );

		return $response->getBody()->write( $this->page->getMarkupContent() );
	}

	private function drawContent( $data = [] )
	{
		$content =
			( new HtmlDiv() )
				->withClass( 'container' )
				->withStyle( 'max-width', '550px' )
				->withStyle( 'margin-top', '30px' )
				->withViewContent( 'pages/makeadmin.php', $data );

		if(isset($data['msg']))
			$content->withViewContent(
				'/common/alerts.php',
				$data['msg']
			);

		$this->page
			->withPageTitle( 'Register page' )
			->withContent( $content )
			->withCssFile( '/css/custom.css' );
	}


	private function makeAdmin( $user_email ) {

		$errorMessage = false;

		/** @var UserModel $user */
		$user = UserService::getInstance()->getUserByEmail($user_email, true);
		if(!$user) {
			$errorMessage = 'User not found';
			return $errorMessage;
		}

		$jwtArray=HelperIb::JwtDecode($user->getToken());
		$jwtArray['user_admin'] = 1;
		$newToken = HelperIb::JwtEncode($jwtArray);
		UserService::getInstance()->updateUserById($user->getId(), ['user_token' => $newToken]);


		return $errorMessage;
	}
}