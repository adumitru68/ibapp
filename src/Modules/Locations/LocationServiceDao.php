<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/24/2018
 * Time: 11:21 AM
 */

namespace IB\Modules\Locations;


use Qpdb\QueryBuilder\DB\DbService;
use Qpdb\QueryBuilder\QueryBuild;

class LocationServiceDao
{

	/**
	 * @var LocationServiceDao
	 */
	protected static $instance;


	/**
	 * @return array|int|mixed|null|string
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function getCountries()
	{
		return QueryBuild::select( 'countries' )->fields( 'id, name as text' )->execute();
	}

	/**
	 * @param int $countryId
	 * @return array|int|mixed|null|string
	 * @throws \Qpdb\QueryBuilder\Dependencies\QueryException
	 */
	public function getCitiesByCountryId( $countryId )
	{

		/** $sql $sql = "SELECT cities.id, cities.name AS text FROM cities
				INNER JOIN states ON cities.state_id = states.id
				INNER JOIN countries ON states.country_id = countries.id
				WHERE countries.id=?";
		return DbService::getInstance()->query( $sql, [ $countryId ] );*/

		/**
		 * Fiind un test am pus si query-ul. Pt query-uri am creat un builder ce este public pe github.com
		 */

		return QueryBuild::select( 'cities' )
			->fields('cities.id, cities.name AS text')
			->innerJoin( 'states', 'cities.state_id', 'states.id' )
			->innerJoin( 'countries', 'states.country_id', 'countries.id' )
			->whereEqual( 'countries.id', $countryId )
			->execute();

	}


	/**
	 * @return LocationServiceDao
	 */
	public static function getInstance()
	{
		if ( is_null( self::$instance ) )
			self::$instance = new self();

		return self::$instance;
	}

}