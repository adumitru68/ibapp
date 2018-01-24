<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/24/2018
 * Time: 10:47 AM
 */

namespace IB\Modules\Locations;


class LocationService
{

	/**
	 * @var LocationService
	 */
	protected static $instance;


	/**
	 * @return array
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function getCountries()
	{
		return LocationServiceDao::getInstance()->getCountries();
	}

	/**
	 * @param int $countryId
	 * @return array
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function getCitiesByCountryId( $countryId )
	{
		return LocationServiceDao::getInstance()->getCitiesByCountryId( $countryId );
	}


	/**
	 * @return LocationService
	 */
	public static function getInstance()
	{
		if ( is_null( self::$instance ) )
			self::$instance = new self();

		return self::$instance;
	}

}