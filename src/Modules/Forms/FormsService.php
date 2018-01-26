<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/26/2018
 * Time: 11:04 PM
 */

namespace IB\Modules\Forms;


use Qpdb\QueryBuilder\Statements\QuerySelect;

class FormsService
{

	/**
	 * @var FormsService
	 */
	private static $instance;


	/**
	 * @param int $formsId
	 * @return bool|FormsModel
	 */
	public function getFormById( $formsId )
	{
		$form = FormsServiceDao::getInstance()->getFormById( $formsId );
		if ( $form )
			return new FormsModel( $form );

		return false;
	}


	/**
	 * @param int $formId
	 * @param array $updates
	 * @return int
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function updateFormById( $formId, array $updates )
	{
		return FormsServiceDao::getInstance()->updateFormById($formId, $updates);
	}


	/**
	 * @param int $formId
	 * @return int
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function deleteFormById( $formId )
	{
		return FormsServiceDao::getInstance()->deleteFormById($formId);
	}


	/**
	 * @param QuerySelect $query
	 * @return FormsModel[]
	 */
	public function getFormsBySelectObject( QuerySelect $query )
	{
		$models = [];
		$rows = $query->execute();
		foreach ($rows as $row)
			$models[] = new FormsModel($row);

		return $models;
	}


	/**
	 * @return FormsService
	 */
	public static function getInstance()
	{
		if ( is_null( self::$instance ) )
			self::$instance = new self();

		return self::$instance;
	}

}