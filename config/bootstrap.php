<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 10/8/2017
 * Time: 12:56 PM
 */

use Qpdb\QueryBuilder\DB\DbConfig;
use Qpdb\SlimApplication\Config\ConfigService;

ConfigService::getInstance(__DIR__ . '/global.php');
DbConfig::getInstance()->withConfigPath(__DIR__ . '/db/db_config.php');