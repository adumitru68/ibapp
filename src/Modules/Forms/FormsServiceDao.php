<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/26/2018
 * Time: 11:07 PM
 */

namespace IB\Modules\Forms;


use Qpdb\QueryBuilder\QueryBuild;

class FormsServiceDao
{

	/**
	 * @var FormsServiceDao
	 */
	private static $instance;


	/**
	 * @param int $formsId
	 * @return array|bool
	 */
	public function getFormById( $formsId )
	{
		return QueryBuild::select( 'forms' )
			->whereEqual( 'form_id', $formsId )
			->first()
			->execute();
	}

	/**
	 * @param string $filter
	 * @return array
	 */
	public function getFormsByFilter( $filter = '' )
	{
		$filter = trim( $filter );
		$query = QueryBuild::select( 'forms' )->orderByDesc('form_id');
		if ( !empty( $filter ) ) {
			$filter = '%' . $filter . '%';
			$query->whereLike( 'form_name', $filter );
		}

		return $query->execute();
	}

	/**
	 * @param array $insert
	 * @return int|null
	 */
	public function createForm( array $insert )
	{
		return QueryBuild::insert( 'forms' )
			->setFieldsByArray( $insert )
			->execute();
	}

	/**
	 * @param int $formId
	 * @param array $updates
	 * @return int
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function updateFormById( $formId, array $updates )
	{
		return QueryBuild::update( 'forms' )
			->setFieldsByArray( $updates )
			->whereEqual( 'form_id', $formId )
			->limit( 1 )
			->execute();
	}

	/**
	 * @param int $formId
	 * @return int
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function deleteFormById( $formId )
	{
		return QueryBuild::delete( 'forms' )
			->whereEqual( 'form_id', $formId )
			->limit( 1 )
			->execute();
	}

	/**
	 * @return FormsServiceDao
	 */
	public static function getInstance()
	{
		if ( is_null( self::$instance ) )
			self::$instance = new self();

		return self::$instance;
	}

}