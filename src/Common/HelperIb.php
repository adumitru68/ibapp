<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/21/2018
 * Time: 12:54 AM
 */

namespace IB\Common;


use Firebase\JWT\JWT;

class HelperIb
{

	/**
	 * @var string
	 */
	private static $jwt_alg = 'HS256';

	/**
	 * @var string
	 */
	private static $jwt_key = 'hg0059';

	/**
	 * @return string
	 */
	public static function getServerName()
	{
		return str_ireplace( 'www.', '', filter_input( INPUT_SERVER, 'SERVER_NAME', FILTER_DEFAULT ) );
	}

	/**
	 * @param string $string
	 * @return string
	 */
	public static function htmlEntities( $string = '' )
	{
		return htmlentities( $string, ENT_COMPAT | ENT_HTML5, 'utf-8' );
	}

	/**
	 * @param string $string
	 * @return string
	 */
	public static function htmlEntitiesDecode( $string = '' )
	{
		return html_entity_decode( $string, ENT_COMPAT | ENT_HTML5, 'utf-8' );
	}

	/**
	 * @param array $arrayToJwt
	 * @return string
	 */
	public static function JwtEncode( array $arrayToJwt )
	{
		return JWT::encode( $arrayToJwt, self::$jwt_key, self::$jwt_alg );
	}

	/**
	 * @param $jwtToArray
	 * @return array
	 */
	public static function JwtDecode( $jwtToArray )
	{
		return (array)JWT::decode( $jwtToArray, self::$jwt_key, array( self::$jwt_alg ) );
	}

	/**
	 * @param $password
	 * @return bool|string
	 */
	public static function passwordHash( $password )
	{
		return password_hash( $password, PASSWORD_DEFAULT );
	}

	/**
	 * @param string password
	 * @param string $hash
	 * @return bool
	 */
	public static function passwordVerify( $password, $hash )
	{
		return password_verify( $password, $hash );
	}

	/**
	 * @param $date
	 * @param string $format
	 * @return bool
	 */
	public static function validateDate( $date, $format = 'Y-m-d' )
	{
		$d = \DateTime::createFromFormat( $format, $date );

		return $d && $d->format( $format ) == $date;
	}

	/**
	 * @param $password
	 * @param $passwordRe
	 * @return bool
	 */
	public static function passwordEqual( $password, $passwordRe )
	{
		$password = trim( $password );
		$passwordRe = trim( $passwordRe );

		if ( empty( $password ) || empty( $passwordRe ) )
			return false;

		if ( $password == $passwordRe )
			return true;

		return false;
	}


}