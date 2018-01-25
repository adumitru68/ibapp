<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/21/2018
 * Time: 5:24 PM
 */

namespace IB\Modules\Users;


use Qpdb\QueryBuilder\QueryBuild;

class UserServiceDao
{

	/**
	 * @var UserServiceDao
	 */
	protected static $instance;


	/**
	 * @param $id
	 * @return array|int|mixed|null|string
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function getUserById( $id )
	{
		return QueryBuild::select( 'users' )
			->fields( 'users.*, TIMESTAMPDIFF(YEAR, user_dob, CURDATE()) AS user_age' )
			->whereEqual( 'user_id', (int)$id )
			->first()
			->execute();
	}

	/**
	 * @param $email
	 * @return array|int|mixed|null|string
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function getUserByEmail( $email )
	{
		return QueryBuild::select( 'users' )
			->fields( 'users.*, TIMESTAMPDIFF(YEAR, user_dob, CURDATE()) AS user_age' )
			->whereEqual( 'user_id', $email )
			->first()
			->execute();
	}

	/**
	 * @param array $userData
	 * @return array|int|null
	 */
	public function createUser( array $userData )
	{
		return QueryBuild::insert( 'users' )
			->ignore()
			->setFieldsByArray( $userData )
			->execute();
	}

	/**
	 * @param $user_id
	 * @param array $updates
	 * @return int|null
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function updateUserById( $user_id, array $updates )
	{
		return QueryBuild::update( 'users' )
			->setFieldsByArray( $updates )
			->whereEqual( 'user_id', $user_id )
			->execute();
	}

	/**
	 * @param $user_email
	 * @param array $updates
	 * @return int|null
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function updateUserByEmail( $user_email, array $updates )
	{
		return QueryBuild::update( 'users' )
			->setFieldsByArray( $updates )
			->whereEqual( 'user_email', $user_email )
			->execute();
	}

	/**
	 * @return UserServiceDao
	 */
	public static function getInstance()
	{
		if ( is_null( self::$instance ) )
			self::$instance = new self();

		return self::$instance;
	}

}