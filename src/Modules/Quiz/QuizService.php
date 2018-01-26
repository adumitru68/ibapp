<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/26/2018
 * Time: 9:21 PM
 */

namespace IB\Modules\Quiz;



class QuizService
{

	/**
	 * @var QuizService
	 */
	private static $instance;


	/**
	 * @param $quizId
	 * @return bool|QuizModel
	 */
	public function getQuizById( $quizId )
	{
		$quizDao = QuizServiceDao::getInstance()->getQuizById( $quizId );
		if ( $quizDao )
			return new QuizModel( $quizDao );

		return false;
	}


	/**
	 * @param $formId
	 * @return QuizModel[]
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function getQuizFormId( $formId )
	{
		$quizArray = [];
		$daoRows = QuizServiceDao::getInstance()->getQuizByFormId( $formId );
		foreach ( $daoRows as $quiz)
			$quizArray[] = new QuizModel($quiz);

		return $quizArray;
	}


	/**
	 * @param $quizId
	 * @param array $updates
	 * @return int
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function updateQuizById( $quizId, array $updates )
	{
		return QuizServiceDao::getInstance()->updateQuizById( $quizId, $updates );
	}


	/**
	 * @param $quizId
	 * @return int
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function deleteQuizById( $quizId )
	{
		return QuizServiceDao::getInstance()->deleteQuizById($quizId);
	}


	/**
	 * @return QuizService
	 */
	public static function getInstance()
	{
		if ( is_null( self::$instance ) )
			self::$instance = new self();

		return self::$instance;
	}

}