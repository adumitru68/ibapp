<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/21/2018
 * Time: 12:54 AM
 */

namespace IB\Common;


class HelperIb
{

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
		return htmlentities( $string, ENT_COMPAT|ENT_HTML5, 'utf-8' );
	}

	/**
	 * @param string $string
	 * @return string
	 */
	public static function htmlEntitiesDecode( $string = '' )
	{
		return html_entity_decode( $string, ENT_COMPAT|ENT_HTML5, 'utf-8' );
	}

}