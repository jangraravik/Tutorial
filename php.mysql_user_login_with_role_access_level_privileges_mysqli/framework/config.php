<?php

error_reporting(-1);
session_start();

require('common.php');
require('user.php');
require('api_driver_mysqli.php');

define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'root');
define('DB_SERVER_PASSWORD', 'root');
define('DB_DATABASE', 'user_login_with_role_access_level_privileges');
define('PROJECT_NAME', 'User Login with Role Access Level Privileges');
$db = dbConnect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE);