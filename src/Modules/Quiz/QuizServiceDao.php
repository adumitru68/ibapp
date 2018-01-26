<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/26/2018
 * Time: 9:42 PM
 */

namespace IB\Modules\Quiz;


use Qpdb\QueryBuilder\QueryBuild;

class QuizServiceDao
{

	/**
	 * @var QuizServiceDao
	 */
	private static $instance;



	/**
	 * @param int $quizId
	 * @return bool|array
	 */
	public function getQuizById( $quizId )
	{
		return QueryBuild::select( 'quiz' )
			->whereEqual( 'quiz_id', $quizId )
			->first()
			->execute();
	}

	/**
	 * @param $formId
	 * @return array
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function getQuizByFormId( $formId )
	{
		return QueryBuild::select( 'quiz' )
			->whereEqual( 'form_id', $formId )
			->orderBy( 'quiz_ord' )
			->execute();
	}

	/**
	 * @param $quizId
	 * @param array $updates
	 * @return int
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function updateQuizById( $quizId, array $updates )
	{
		return QueryBuild::update( 'quiz' )
			->setFieldsByArray( $updates )
			->whereEqual( 'quiz_id', $quizId )
			->limit( 1 )
			->execute();
	}

	/**
	 * @param $quizId
	 * @return int
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function deleteQuizById( $quizId )
	{
		return QueryBuild::delete( 'quiz' )
			->whereEqual( 'quiz_id', $quizId )
			->limit( 1 )
			->execute();
	}

	/**
	 * @return QuizServiceDao
	 */
	public static function getInstance()
	{
		if ( is_null( self::$instance ) )
			self::$instance = new self();

		return self::$instance;
	}


}