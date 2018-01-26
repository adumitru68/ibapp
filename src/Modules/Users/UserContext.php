<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/26/2018
 * Time: 12:53 AM
 */

namespace IB\Modules\Users;


use IB\Common\SessionIb;

class UserContext
{

	/**
	 * @return bool
	 * @throws \IB\Common\SessionIbException
	 */
	public static function isUser()
	{
		return (bool)SessionIb::getInstance()->get( 'userSession.isUser', false );
	}

	/**
	 * @return bool
	 * @throws \IB\Common\SessionIbException
	 */
	public static function isAdmin()
	{
		return (bool)SessionIb::getInstance()->get( 'userSession.isAdmin', false );
	}

	/**
	 * @return int
	 * @throws \IB\Common\SessionIbException
	 */
	public static function userId()
	{
		return (int)SessionIb::getInstance()->get( 'userSession.userId', null );
	}

	/**
	 * @return string
	 * @throws \IB\Common\SessionIbException
	 */
	public static function userEmail()
	{
		return (string)SessionIb::getInstance()->get( 'userSession.userEmail', null );
	}

}