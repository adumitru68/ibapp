<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/21/2018
 * Time: 5:33 PM
 */

namespace IB\Modules\Users;


use IB\Common\HelperIb;

class UserModel
{

	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $email;

	/**
	 * @var string
	 */
	private $fullName;

	/**
	 * @var mixed
	 */
	private $token;

	/**
	 * @var bool
	 */
	private $isAdmin;

	/**
	 * @var array
	 */
	private $daoRow;


	/**
	 * UserModel constructor.
	 * @param array $daoRow
	 */
	public function __construct( array $daoRow )
	{
		$this->daoRow = $daoRow;
		$this->id = (int)$daoRow['user_id'];
		$this->email = (string)$daoRow[ 'user_email' ];
		$this->fullName = (string)$daoRow['user_name'];
		$this->token = $daoRow['user_token'];
		$this->isAdmin = (bool)HelperIb::JwtDecode($this->token)['user_admin'];
	}

	/**
	 * @param int $id
	 */
	public function setId( $id )
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @return string
	 */
	public function getFullName()
	{
		return $this->fullName;
	}

	/**
	 * @return mixed
	 */
	public function getToken()
	{
		return $this->token;
	}

	/**
	 * @return bool
	 */
	public function isAdmin()
	{
		return $this->isAdmin;
	}

	/**
	 * @return array
	 */
	public function getDaoRow()
	{
		return $this->daoRow;
	}


}