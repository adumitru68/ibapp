<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/22/2018
 * Time: 3:07 AM
 */

namespace IB\Html;


use IB\Html\Interfaces\HtmlElementInterface;

abstract class AbstractHtmlElement
{

	/**
	 * @var string
	 */
	protected $id;

	/**
	 * @var HtmlElementInterface[]|string
	 */
	protected $htmlElements = [];

	/**
	 * @var array
	 */
	protected $styles = [];

	/**
	 * @var array
	 */
	protected $classes = [];

	/**
	 * @var array
	 */
	protected $attributes = [];

	/**
	 * @var
	 */
	protected $tag;


	/**
	 * @param $id string
	 * @return $this
	 */
	public function withId( $id )
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @param array ...$classes
	 * @return $this
	 */
	public function withClass( ...$classes )
	{
		foreach ( $classes as $class ) {
			$this->classes[] = $class;
		}

		return $this;
	}

	/**
	 * @param string $styleName
	 * @param string $styleValue
	 * @return $this
	 */
	public function withStyle( $styleName, $styleValue )
	{
		$styleName = trim((string)$styleName);
		$styleValue = trim((string)$styleValue);

		if ($styleName !== '') {
			$this->styles[ $styleName ] = $styleValue;
		}

		return $this;
	}

	/**
	 * @param $attributeName
	 * @param $attributeValue
	 * @return $this
	 */
	public function withAttribute( $attributeName, $attributeValue )
	{
		$attributeName = trim((string)$attributeName);
		$attributeValue = trim((string)$attributeValue);

		if ($attributeName !== '') {
			$this->attributes[ $attributeName ] = $attributeValue;
		}

		return $this;
	}

	/**
	 * @return string
	 */
	protected function getComputedCSSStyle() {
		$result = [];
		foreach ($this->styles as $styleName => $styleValue ) {
			if ($styleValue !== '') {
				$result[] = $styleName . ': ' . $styleValue;
			}
		}
		return implode('; ', $result);
	}

}