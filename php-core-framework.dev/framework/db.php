<?php

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('You cannot directly access this file'); };

require_once 'php-activerecord-1.1.2/ActiveRecord.php';
ActiveRecord\Config::initialize(function($cfg)
{
$cfg->set_model_directory(__DIR__.'\model');
$cfg->set_connections(array(
	'development'=>"mysql://root:root@localhost:3366/php-core-framework",
	'production' =>"",
	'test' =>''
));
$cfg->set_default_connection('development');
});
