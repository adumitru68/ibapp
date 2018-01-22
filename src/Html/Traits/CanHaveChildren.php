<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/22/2018
 * Time: 2:54 AM
 */

namespace IB\Html\Traits;


use IB\Html\Interfaces\HtmlElementInterface;

trait CanHaveChildren
{

	/**
	 * @var HtmlElementInterface[]|string
	 */
	protected $htmlElements;

	/**
	 * @param HtmlElementInterface $html
	 * @return $this
	 */
	public function withHtmlElement( HtmlElementInterface $html )
	{
		$this->htmlElements[] = $html;
		return $this;
	}

	/**
	 * @param string $html
	 * @return $this
	 */
	public function withContent( $html )
	{
		$this->htmlElements[] = $html;
		return $this;
	}

}