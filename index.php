#!/usr/bin/env php
<?php
if (php_sapi_name() != 'cli') {
    exit("Not Access\n");
}
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('FCPATH', str_replace(SELF, '', __FILE__));
require(FCPATH . 'core/AutoLoader.php');
$autoLoader = new \DCLIT\core\AutoLoader();
$autoLoader->register();

if (count($argv) < 2) {
    $argv[1] = 'Help';
}
$Runner = new \DCLIT\core\Runner();
call_user_func_array([$Runner, 'run'], array_slice($argv, 1));
