<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/21/2018
 * Time: 1:08 AM
 */

namespace IB\Common;


use Qpdb\SlimApplication\Config\ConfigService;

final class SessionIb
{

	/**
	 * @var SessionIb
	 */
	private static $instance;

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var array
	 */
	protected $cookie;

	/**
	 * @var bool
	 */
	protected $isStarted = false;


	/**
	 * SessionIb constructor.
	 * @throws \Qpdb\SlimApplication\Config\ConfigException
	 */
	protected function __construct()
	{
		$this->name = ConfigService::getInstance()->getProperty( 'sessionCfg.name' );
		$this->cookie = ConfigService::getInstance()->getProperty( 'sessionCfg.cookie' );
		$this->setup();
	}


	/**
	 * @return SessionIb
	 * @throws SessionIbException
	 */
	public static function getInstance()
	{
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		self::$instance->start();
		if ( !self::$instance->isFingerprint() ) {
			self::$instance->forget();
			throw new SessionIbException( 'Fingerprint violation', 1 );
		}

		return self::$instance;
	}

	private function setup()
	{
		ini_set( 'session.use_cookies', 1 );
		ini_set( 'session.use_only_cookies', 1 );
		session_name( ConfigService::getInstance()->getProperty( 'sessionCfg.name' ) );
		session_set_cookie_params(
			$this->cookie[ 'lifetime' ],
			$this->cookie[ 'path' ],
			$this->cookie[ 'domain' ],
			$this->cookie[ 'secure' ],
			$this->cookie[ 'httponly' ]
		);
	}

	public function start()
	{
		if ( session_id() === '' ) {
			if ( session_start() ) {
				return mt_rand( 0, 4 ) === 0 ? $this->refresh() : true; // 1/5
			}
		}

		return false;
	}

	public function forget()
	{

		if ( session_id() === '' ) {
			$this->clearCookie();

			return false;
		}
		$_SESSION = [];
		$this->clearCookie();

		return session_destroy();
	}

	protected function clearCookie()
	{
		setcookie(
			$this->name,
			'',
			time() - 42000,
			$this->cookie[ 'path' ],
			$this->cookie[ 'domain' ],
			$this->cookie[ 'secure' ],
			$this->cookie[ 'httponly' ]
		);
	}

	public function refresh()
	{
		return session_regenerate_id( true );
	}

	public function isFingerprint()
	{
		$hash = md5(
			$_SERVER[ 'HTTP_USER_AGENT' ] .
			( ip2long( $_SERVER[ 'REMOTE_ADDR' ] ) & ip2long( '255.255.0.0' ) )
		);

		if ( isset( $_SESSION[ '_fingerprint' ] ) ) {
			return $_SESSION[ '_fingerprint' ] === $hash;
		}

		$_SESSION[ '_fingerprint' ] = $hash;

		return true;
	}

	/**
	 * @param $name
	 * @param null $default_value
	 * @return null
	 */
	public function get( $name, $default_value = null )
	{
		$parsed = explode( '.', $name );
		$result = $_SESSION;

		while ( $parsed ) {
			$next = array_shift( $parsed );

			if ( isset( $result[ $next ] ) ) {
				$result = $result[ $next ];
			}
			else {
				if ( isset( $default_value ) ) {
					$this->put( $name, $default_value );
				}

				return $default_value;
			}
		}

		return $result;
	}

	/**
	 * @param $name
	 * @param $value
	 */
	public function put( $name, $value )
	{
		$parsed = explode( '.', $name );

		$session = &$_SESSION;

		while ( count( $parsed ) > 1 ) {
			$next = array_shift( $parsed );

			if ( !isset( $session[ $next ] ) || !is_array( $session[ $next ] ) ) {
				$session[ $next ] = [];
			}
			$session = &$session[ $next ];
		}

		$session[ array_shift( $parsed ) ] = $value;
	}


}