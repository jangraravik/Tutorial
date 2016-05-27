<?php

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('You cannot directly access this file'); };

##########################################################################
## Set All Values That are Required in CORE/CI Script					##
##########################################################################
date_default_timezone_set('Asia/Kolkata');
/*
For the United States:
Eastern ........... America/New_York
Central ........... America/Chicago
Mountain .......... America/Denver
Mountain no DST ... America/Phoenix
Pacific ........... America/Los_Angeles
Alaska ............ America/Anchorage
Hawaii ............ America/Adak
Hawaii no DST ..... Pacific/Honolulu
*/

##########################################################################
## Attach Required Files												##
##########################################################################
require_once 'Framework/lib/class_session.php';
require_once 'Framework/lib/class_sitelog.php';
require_once 'Framework/db.php';

##########################################################################
## Attach Optional Files												##
##########################################################################
require_once 'Framework/faker/src/autoload.php';



##########################################################################
## Server Values  														##
##########################################################################
define("DOMAIN","http://".$_SERVER['HTTP_HOST']);
define("SITE_GOOGLE_ANALYTICS","UCGG345343-1");
define("ADMIN_MAIL_TO","jangra.ravik@outlook.com");
define("ADMIN_MAIL_CC","");
define("ADMIN_MAIL_BCC","");
define("ADMIN_MAIL_NO_REPLY_EMAIL","noreply@domain.com");