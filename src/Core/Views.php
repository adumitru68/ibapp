<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/20/2018
 * Time: 9:10 PM
 */

namespace IB\Core;


class Views
{

	/**
	 * @param string $templatePath
	 * @param array $data
	 * @param bool $returnContent
	 * @return null|string
	 * @throws ViewsException
	 */
	public static function loadView( $templatePath, array $data = [], $returnContent = true )
	{
		$templatePath = self::getRealPath($templatePath);
		foreach ( $data as $key => $v )
			$$key = $v;

		ob_start();
		/** @noinspection PhpIncludeInspection */
		include $templatePath;
		$viewContent = ob_get_clean();

		if($returnContent)
			return $viewContent;

		return null;

	}

	/**
	 * @param string $templatePath
	 * @return string
	 * @throws ViewsException
	 */
	private static function getRealPath( $templatePath )
	{
		$realPath = __DIR__ . '/../../templates/' . trim( $templatePath, '/' );
		if(!file_exists($realPath))
			throw new ViewsException('Invalid template file path: ' . $realPath);

		return $realPath;
	}

}