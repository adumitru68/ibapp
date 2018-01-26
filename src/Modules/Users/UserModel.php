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
	 * @var int
	 */
	private $age;

	/**
	 * @var string
	 */
	private $hashPassword;


	/**
	 * UserModel constructor.
	 * @param array $daoRow
	 */
	public function __construct( array $daoRow )
	{
		$this->daoRow = $daoRow;
		$this->id = (int)$daoRow['user_id'];
		$this->email = (string)$daoRow[ 'user_email' ];
		$this->hashPassword = $daoRow['user_pass'];
		$this->fullName = (string)$daoRow['user_name'];
		$this->token = $daoRow['user_token'];
		$this->age = (int)$daoRow['user_age'];
		$this->isAdmin = (bool)HelperIb::JwtDecode($this->token)['user_admin'];
	}


	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
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
	public function getHashPassword()
	{
		return $this->hashPassword;
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

	/**
	 * @return int
	 */
	public function getAge()
	{
		return $this->age;
	}


}