<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/20/2018
 * Time: 6:51 PM
 */

use Qpdb\SlimApplication\SlimApplicationDI;

include_once __DIR__ . '/../vendor/autoload.php';

SlimApplicationDI::routerService()->run();