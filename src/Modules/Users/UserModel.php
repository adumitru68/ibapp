<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/21/2018
 * Time: 5:33 PM
 */

namespace IB\Modules\Users;


class UserModel
{

	private $daoRow;


	public function __construct( array $daoRow )
	{
		$this->daoRow = $daoRow;
		$this->email = (string)$daoRow[ 'user_email' ];
		$this->fullName = (string)$daoRow['user_name'];
		$this->profession = (string)$daoRow['user_prof'];
	}

}