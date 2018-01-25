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
		$this->dataValue = trim($value);
		$this->errorCollector[] = $this->dataValue;
	}

	/**
	 * @return bool
	 */
	public function isValid()
	{
		if(count($this->errorCollector) > 1)
			return false;

		return true;
	}

	/**
	 * @return array
	 */
	public function getErrorsCollector()
	{
		return $this->errorCollector;
	}

	/**
	 * Passed email or empty string
	 * @param string $errorMessage
	 * @return $this
	 */
	public function isEmail( $errorMessage = "Invalid email" )
	{
		$data = strval( $this->dataValue );

		if ( !filter_var( $data, FILTER_VALIDATE_EMAIL ) )
			$this->errorCollector[] = $errorMessage;

		return $this;
	}

	/**
	 * @param string $format
	 * @param string $errorMessage
	 * @return $this
	 */
	public function isDate( $format = 'Y-m-d', $errorMessage = "Invalid date" )
	{
		$date = strval( $this->dataValue );

		if ( !HelperIb::validateDate( $date, $format ) )
			$this->errorCollector[] = $errorMessage;

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
			$this->errorCollector[] = $errorMessage;

		return $this;
	}

	/**
	 * @param string $errorMessage
	 * @return $this
	 */
	public function isNumeric( $errorMessage = "Not is numeric" )
	{
		if(!is_numeric($this->dataValue))
			$this->errorCollector[] = $errorMessage;

		return $this;
	}

	/**
	 * @param string $password
	 * @param string|null $password_re
	 * @param string $errorMessage
	 * @return $this
	 */
	public function isValidPassword( $password_re = null, $errorMessage = "Invalid password" )
	{
		if(!HelperIb::passwordEqual($this->dataValue, $password_re))
			$this->errorCollector[] = $errorMessage;

		return $this;
	}

	/**
	 * @param string $errorMessage
	 * @return $this
	 */
	public function notZero( $errorMessage = "Not is numeric" )
	{
		if($this->dataValue == '0')
			$this->errorCollector[] = $errorMessage;

		return $this;
	}


}