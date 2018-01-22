<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/22/2018
 * Time: 3:42 AM
 */

namespace IB\Html;


use IB\Html\Interfaces\HtmlElementInterface;
use IB\Html\Traits\CanHaveChildren;
use IB\Html\Traits\MarkupGenerator;

class HtmlDiv extends AbstractHtmlElement implements HtmlElementInterface
{

	use CanHaveChildren, MarkupGenerator;

	protected $tag = 'div';

}