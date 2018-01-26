<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/26/2018
 * Time: 9:38 PM
 */

namespace IB\Modules\Quiz;


class QuizModel
{


	/**
	 * @var string
	 */
	private $question;

	/**
	 * @var string
	 */
	private $options;

	/**
	 * @var int
	 */
	private $controlType;

	/**
	 * @var int
	 */
	private $formId;

	/**
	 * @var int
	 */
	private $id;



	public function __construct( array $daoRow )
	{
		$this->question = (string)$daoRow['quiz_question'];
		$this->options = (string)$daoRow['quiz_options'];
		$this->controlType = (int)$daoRow['quiz_control'];
		$this->formId = (int)$daoRow['form_id'];
		$this->id = (int)$daoRow['quiz_id'];
	}

	/**
	 * @return string
	 */
	public function getQuestion()
	{
		return $this->question;
	}

	/**
	 * @param bool $decode
	 * @return string|array
	 */
	public function getOptions( $decode = true )
	{
		if($decode)
			return json_decode($this->options, true );

		return $this->options;
	}

	/**
	 * @return int
	 */
	public function getControlType()
	{
		return $this->controlType;
	}

	/**
	 * @return int
	 */
	public function getFormId()
	{
		return $this->formId;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}


}