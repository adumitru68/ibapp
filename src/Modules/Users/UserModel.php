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

	public function __construct( array $daoRow )
	{
		$this->id = (int)$daoRow['user_id'];
		$this->email = (string)$daoRow[ 'user_email' ];
		$this->fullName = (string)$daoRow['user_name'];
		$this->token = $daoRow['user_token'];
	}

}