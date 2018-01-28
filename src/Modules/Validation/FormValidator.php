<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/24/2018
 * Time: 8:41 PM
 */

namespace IB\Modules\Validation;


class FormValidator
{

	/**
	 * @var array
	 */
	private $errors = [];

	/**
	 * @var array
	 */
	private $daoRow = [];


	/**
	 * @param $varName
	 * @param DataValidation $validation
	 * @param null|string $id
	 * @return $this
	 */
	public function withFieldValidation( $varName, DataValidation $validation, $id = null )
	{

		$this->daoRow[ $varName ] = $validation->getErrorsCollector()[ 0 ];

		if ( !$validation->isValid() ){
			if(empty($id))
				$this->errors[ $varName ] = $validation->getErrorsCollector()[ 1 ];
			else
				$this->errors[ $id ] = $validation->getErrorsCollector()[ 1 ];
		}


		return $this;
	}

	/**
	 * @param string $varName
	 * @param string $errorMessage
	 * @return $this
	 */
	public function addError( $varName, $errorMessage )
	{
		$this->errors[ $varName ] = $errorMessage;

		return $this;
	}

	/**
	 * @param string $varName
	 * @param mixed $newValue
	 * @return $this
	 */
	public function editData( $varName, $newValue )
	{
		$this->daoRow[ $varName ] = $newValue;

		return $this;
	}

	/**
	 * @param $varName
	 * @return mixed
	 * @throws FormValidationException
	 */
	public function getDataValue( $varName )
	{
		if ( !array_key_exists( $varName, $this->daoRow ) )
			throw new FormValidationException( 'Not found ' . $varName );

		return $this->daoRow[ $varName ];
	}

	/**
	 * @return array
	 */
	public function getFormErrors()
	{
		return $this->errors;
	}

	/**
	 * @return array
	 */
	public function getFormDao()
	{
		return $this->daoRow;
	}


}