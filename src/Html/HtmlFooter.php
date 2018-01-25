<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/24/2018
 * Time: 4:16 PM
 */

namespace IB\Html;


use IB\Html\Interfaces\HtmlElementInterface;
use IB\Html\Traits\CanHaveChildren;
use IB\Html\Traits\MarkupGenerator;

class HtmlFooter extends AbstractHtmlElement implements HtmlElementInterface
{

	use CanHaveChildren, MarkupGenerator;

	protected $tag = 'footer';

}