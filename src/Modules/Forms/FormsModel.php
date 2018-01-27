<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/26/2018
 * Time: 11:48 PM
 */

namespace IB\Modules\Forms;


class FormsModel
{

	private $daoRow;

	private $name;
	private $minAge;
	private $id;
	private $status;

	public function __construct( array $daoRow )
	{
		$this->name = (string)$daoRow['form_name'];
		$this->minAge = (int)$daoRow['form_min_age'];
		$this->status = (int)$daoRow['form_status'];
		$this->id = (int)$daoRow['form_id'];
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return int
	 */
	public function getMinAge()
	{
		return $this->minAge;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return int
	 */
	public function getStatus()
	{
		return $this->status;
	}

}