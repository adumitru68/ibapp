<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/20/2018
 * Time: 6:51 PM
 */

use IB\Html\HtmlDiv;
use Qpdb\QueryBuilder\QueryBuild;
use Qpdb\SlimApplication\SlimApplicationDI;

include_once __DIR__ . '/../vendor/autoload.php';

SlimApplicationDI::routerService()->run();

//var_dump(\IB\Modules\Users\UserService::getInstance()->getUserById(1));

$html = (new HtmlDiv())
	->withClass('ana','are','mere')
	->withId('bbb')
	->withHtmlElement(
		(new HtmlDiv())
			->withId('ggg')
	)
	->withContent("<span>gdgdgd</span>")
	->withHtmlElement(
		(new \IB\Html\HtmlNav())
			->withClass('test')
	)
	->getHTMLMarkup();

//var_dump($html);