<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/22/2018
 * Time: 4:30 AM
 */

namespace IB\Html;


use IB\Html\Interfaces\HtmlElementInterface;
use IB\Html\Traits\CanHaveChildren;
use IB\Html\Traits\MarkupGenerator;

class HtmlNav extends AbstractHtmlElement implements HtmlElementInterface
{

	use CanHaveChildren, MarkupGenerator;

	protected $tag = 'nav';

}