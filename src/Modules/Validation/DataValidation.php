<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/24/2018
 * Time: 12:59 PM
 */

namespace IB\Modules\Validation;


use IB\Common\HelperIb;

class DataValidation
{

	/**
	 * @var mixed
	 */
	protected $dataValue;

	/**
	 * @var array
	 */
	protected $errorCollector = [];

	/**
	 * @var bool
	 */
	protected $valid = true;

	const EMAIL = 'email';
	const DATE = 'date';
	const NUMERIC = 'numeric';
	const NOT_EMPTY= 'not_empty';


	/**
	 * DataValidation constructor.
	 * @param mixed $value
	 */
	public function __construct( $value )
	{
		$this->dataValue = $value;
	}

	/**
	 * @return bool
	 */
	public function isValid()
	{
		if(count($this->errorCollector))
			return false;

		return true;
	}

	/**
	 * @return array
	 */
	public function getErrors()
	{
		return $this->errorCollector;
	}

	/**
	 * Passed email or empty string
	 * @param string $errorMessage
	 * @return $this
	 */
	public function Email( $errorMessage = "Invalid email" )
	{
		$data = strval( $this->dataValue );

		if ( empty( $data ) )
			return $this;

		if ( !filter_var( $data, FILTER_VALIDATE_EMAIL ) )
			$this->errorCollector[ self::EMAIL ] = $errorMessage;

		return $this;
	}

	/**
	 * @param string $format
	 * @param string $errorMessage
	 * @return $this
	 */
	public function Date( $format = 'Y-m-d', $errorMessage = "Invalid date" )
	{
		$date = strval( $this->dataValue );

		if ( empty( $date ) )
			return $this;

		if ( !HelperIb::validateDate( $date, $format ) )
			$this->errorCollector[ self::DATE ] = $errorMessage;

		return $this;
	}


	/**
	 * @param string $errorMessage
	 * @return $this
	 */
	public function notEmpty( $errorMessage = "Is empty" )
	{
		$data = strval( $this->dataValue );

		if(empty($data))
			$this->errorCollector[self::NOT_EMPTY] = $errorMessage;

		return $this;
	}

	/**
	 * @param string $errorMessage
	 * @return $this
	 */
	public function numeric( $errorMessage = "Not is numeric" )
	{
		if(!is_numeric($this->dataValue))
			$this->errorCollector[self::NUMERIC] = $errorMessage;

		return $this;
	}


}