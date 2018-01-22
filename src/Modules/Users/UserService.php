<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/21/2018
 * Time: 5:06 PM
 */

namespace IB\Modules\Users;


use IB\Common\SessionIb;

class UserService
{

	/**
	 * @var UserService
	 */
	protected static $instance;

	/**
	 * @var UserModel
	 */
	protected $userModel;


	/**
	 * UserService constructor.
	 */
	protected function __construct(){}

	/**
	 * @return int
	 * @throws \IB\Common\SessionIbException
	 */
	public function isLogged()
	{
		return SessionIb::getInstance()->get('user.id', 0);
	}

	/**
	 * @return int
	 * @throws \IB\Common\SessionIbException
	 */
	public function isAdmin()
	{
		if(!$this->isLogged())
			return 0;

		return 0;
	}

	public function login( $userEmail, $userPass )
	{

	}

	public function register ( array $newUser )
	{

	}

	/**
	 * @param integer $id
	 * @param bool $asModel
	 * @return array|bool|UserModel
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function getUserById( $id, $asModel = false )
	{
		$user = UserServiceDao::getInstance()->getUserById( $id );

		if(!$user)
			return null;

		if ( $asModel )
			$user = new UserModel( $user );

		return $user;
	}

	/**
	 * @param $email
	 * @param bool $asModel
	 * @return array|null
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function getUserByEmail( $email, $asModel = false )
	{
		$user = UserServiceDao::getInstance()->getUserByEmail( $email );

		if(!$user)
			return null;

		if ( $asModel )
			$user = new UserModel( $user );

		return $user;
	}

	public function makeAdmin( $userId )
	{

	}

	/**
	 * @return UserService
	 */
	public static function getInstance()
	{
		if ( is_null( self::$instance ) )
			self::$instance = new self();

		return self::$instance;
	}


}