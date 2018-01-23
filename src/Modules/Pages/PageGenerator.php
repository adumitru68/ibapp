<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/22/2018
 * Time: 9:27 PM
 */

namespace IB\Modules\Pages;


use IB\Common\Views;
use IB\Html\Interfaces\HtmlElementInterface;

class PageGenerator
{

	/**
	 * @var array
	 */
	protected $pageCss = [];

	/**
	 * @var array
	 */
	protected $pageJs = [];

	/**
	 * @var array
	 */
	protected $pageContent = [];


	/**
	 * @param string $filePath
	 * @return $this
	 */
	public function withCssFile( $filePath )
	{
		$this->pageCss[] = $filePath;
		return $this;
	}

	/**
	 * @param string $filePath
	 * @return $this
	 */
	public function withJsFile( $filePath )
	{
		$this->pageJs[] = $filePath;
		return $this;
	}

	/**
	 * @param string $htmlContent
	 * @return $this
	 */
	public function withContent ( $htmlContent = '')
	{
		$this->pageContent[] = $htmlContent;
		return $this;
	}


	/**
	 * @param bool $withDocument
	 * @return string
	 */
	public function getMarkupContent( $withDocument = true)
	{
		$markup = '';

		foreach ( $this->pageCss as $fileCss ) {
			$markup .= "<link href=\"$fileCss\" rel=\"stylesheet\" />";
		}

		foreach ($this->pageContent as $content ) {
			if( $content instanceof HtmlElementInterface )
				$markup .= $content->getHTMLMarkup();
			else
				$markup .= $content;
		}

		foreach ( $this->pageJs as $fileJs ) {
			$markup .= "<script language=\"JavaScript\" src=\"$fileJs\" type=\"text/javascript\"></script>";
		}

		if($withDocument)
			$markup = Views::loadView('document.php',['markup'=>$markup, 'pageTitle'=>'Register form']);

		return $markup;
	}


}