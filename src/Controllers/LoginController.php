<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/25/2018
 * Time: 1:12 PM
 */

namespace IB\Controllers;


use IB\Common\HelperIb;
use IB\Common\SessionIb;
use IB\Controllers\Interfaces\ControllerInterface;
use IB\Html\HtmlDiv;
use IB\Modules\Pages\PageGenerator;
use IB\Modules\Users\UserContext;
use IB\Modules\Users\UserModel;
use IB\Modules\Users\UserService;
use InvalidArgumentException;
use Qpdb\SlimApplication\Utils\SlimAppConst;
use Slim\Http\Request;
use Slim\Http\Response;
use UnexpectedValueException;

class LoginController implements ControllerInterface
{

	/**
	 * @var PageGenerator
	 */
	private $page;

	/**
	 * LoginController constructor.
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
	 * @throws \IB\Common\SessionIbException
	 * @throws \IB\Common\ViewsException
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function indexAction( Request $request, Response $response, array $args = [] )
	{

		$data = empty( $request->getParsedBody() ) ? [] : $request->getParsedBody();

		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			return $response->getBody()->write( 'Session expired');
		}

		if ( $request->getMethod() == SlimAppConst::METHOD_POST ) {
			$this->tryLogin( $request->getParsedBody() );
			$data['isError'] = true;
		}

		if ( UserContext::isUser() ) {
			return $response->withRedirect( '/' );
		}

		$this->drawContent($data);

		return $response->getBody()->write( $this->page->getMarkupContent() );
	}


	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 * @return Response
	 * @throws \IB\Common\SessionIbException
	 */
	public function LogOut ( Request $request, Response $response, array $args = [] )
	{
		SessionIb::getInstance()->forget();
		return $response->withRedirect( '/' );
	}


	/**
	 * @param array $data
	 * @throws \IB\Common\ViewsException
	 */
	private function drawContent( $data = [] )
	{
		$content =
			( new HtmlDiv() )
				->withClass( 'container' )
				->withStyle( 'max-width', '450px' )
				->withStyle( 'margin-top', '30px' )
				->withViewContent( 'pages/login.php', $data );

		if(isset($data['isError']))
			$content->withViewContent(
				'/common/alerts.php',
				['messageType'=>'alert-danger', 'message'=>'Inavalid user or password']
			);

		$this->page
			->withPageTitle( 'Register page' )
			->withContent( $content )
			->withCssFile( '/css/custom.css' );
	}


	/**
	 * @param array $data
	 * @return bool
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 * @throws \IB\Common\SessionIbException
	 */
	private function tryLogin( $data = [] )
	{
		/**
		 * @var UserModel $user
		 */
		$user = UserService::getInstance()->getUserByEmail( $data[ 'user_email' ], true );

		if ( $user && HelperIb::passwordVerify( trim( $data[ 'user_pass' ] ), $user->getHashPassword() ) ) {
			$userSession = [
				'userId' => $user->getId(),
				'userEmail' => $user->getEmail(),
				'isUser' => true,
				'isAdmin' => $this->tryLoginAsAdmin( $user )
			];
			SessionIb::getInstance()->put( 'userSession', $userSession );
		}

		return false;
	}

	/**
	 * @param UserModel $user
	 * @return bool|null
	 */
	private function tryLoginAsAdmin( UserModel $user )
	{
		$isAdmin = false;
		try {
			$jwtArray = HelperIb::JwtDecode( $user->getToken() );
			if ( $jwtArray[ 'user_admin' ] && $jwtArray[ 'user_id' ] == $user->getId() )
				return true;
		} catch ( InvalidArgumentException $e ) {
			$isAdmin = null;
		} catch ( UnexpectedValueException $e ) {
			$isAdmin = null;
		}

		return $isAdmin;

	}

}
