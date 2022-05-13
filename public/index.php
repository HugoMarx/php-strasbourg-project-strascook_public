<?php

session_start();

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 14:01
 */

require_once '/home/u549394581/domains/hugo-marx.com/strascook/vendor/autoload.php';

if (getenv('ENV') === false) {
    require_once '/home/u549394581/domains/hugo-marx.com/strascook/config/debug.php';
    require_once '/home/u549394581/domains/hugo-marx.com/strascook/config/db.php';
}
require_once '/home/u549394581/domains/hugo-marx.com/strascook/config/config.php';
require_once '/home/u549394581/domains/hugo-marx.com/strascook/src/routing.php';
