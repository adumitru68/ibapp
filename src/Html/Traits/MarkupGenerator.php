<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/22/2018
 * Time: 3:44 AM
 */

namespace IB\Html\Traits;


use IB\Html\Interfaces\HtmlElementInterface;

trait MarkupGenerator
{

	/**
	 * @var HtmlElementInterface[]|string[]
	 */
	protected $htmlElements;

	/**
	 * @return string
	 */
	public function getHTMLMarkup()
	{
		$result = [
			'<' . $this->tag . ' '
		];

		$cssStyles = $this->getComputedCSSStyle();

		if ($cssStyles !== '') {
			$result[] = 'style="' . $cssStyles . '" ';
		}

		if (!empty($this->id)) {
			$result[] = 'id="' . htmlentities($this->id, ENT_COMPAT, 'utf-8') . '" ';
		}

		if (count($this->classes)) {
			$result[] = 'class="' . implode(' ', $this->classes) . '" ';
		}

		foreach ($this->attributes as $attributeName => $attributeValue) {
			switch (true) {
				case strpos($attributeValue, '"') !== false:
					$result[] = $attributeName . '=' . "'" . $attributeValue . "' ";
					break;
				case strpos($attributeValue, "'") !== false:
					$result[] = $attributeName . '=' . '"' . $attributeValue . '" ';
					break;
				default:
					$result[] = $attributeName . '=' . '"' . $attributeValue . '" ';
					break;
			}
		}


		$result[] = '>';

		foreach ( $this->htmlElements as $htmlElement) {
			if($htmlElement instanceof HtmlElementInterface )
				$result[] = $htmlElement->getHTMLMarkup();
			else
				$result[] = $htmlElement;
		}

		$result[] = '</' .$this->tag .'>';

		return implode('', $result);
	}

}