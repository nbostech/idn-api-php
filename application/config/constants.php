<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESCTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


if( defined("ENVIRONMENT") && (ENVIRONMENT == "development" || ENVIRONMENT == "testing")){
    // APP
    defined('API_HOST_URL')         OR define('API_HOST_URL', "http://api.qa1.nbos.in/");
    defined('API_CLIENT_ID')        OR define('API_CLIENT_ID', "api-client");
    defined('API_CLIENT_SECRET')    OR define('API_CLIENT_SECRET', "api-secret");

    defined('FACEBOOK_APP_ID')        OR define('FACEBOOK_APP_ID', "510108922524128");
    defined('FACEBOOK_APP_SECRET')    OR define('FACEBOOK_APP_SECRET', "00bd5689d33289cd308ee42df3990467");

    defined('GOOGLE_CLIENT_ID')        OR define('GOOGLE_CLIENT_ID', "934148761240-7uf49nhf76jset1ad8vatqj9pdflghtj.apps.googleusercontent.com");
    defined('GOOGLE_CLIENT_SECRET')    OR define('GOOGLE_CLIENT_SECRET', "udILTlXvc3FuJ55yDN01XrLy");

    defined('INSTAGRAM_API_KEY')       OR define('INSTAGRAM_API_KEY', "0fa38988693e4dd59370a670de2bb28d");
    defined('INSTAGRAM_API_SECRET')    OR define('INSTAGRAM_API_SECRET', "2eb24d4054964079801abd68ffeca1d1");

    defined('GITHUB_OAUTH2_CLIENT_ID')     OR define('GITHUB_OAUTH2_CLIENT_ID', "04b542df48479306d92f");
    defined('GITHUB_OAUTH2_CLIENT_SECRET') OR define('GITHUB_OAUTH2_CLIENT_SECRET', "59d8f9f092ad59174ab78cf8516b438644d1d6ef");

    defined('LINKEDIN_CLIENT_ID')     OR define('LINKEDIN_CLIENT_ID', "750wziffe02w19");
    defined('LINKEDIN_CLIENT_SECRET') OR define('LINKEDIN_CLIENT_SECRET', "RzNPKod8dS5lcAj8");

    defined('TWITTER_CONSUMER_KEY')    OR define('TWITTER_CONSUMER_KEY', "jTm94nxu1hC3tOrxlvlaBKVlN");
    defined('TWITTER_CONSUMER_SECRET') OR define('TWITTER_CONSUMER_SECRET', "fTiW6Irp5zyMaf1DdplryZ7fhN4AXYN0nzqZeB9xzW5j3uXODN");

    defined('CURL_DEBUG') OR define('CURL_DEBUG', true);
    define('API_MODULE_CLIENT_ID', "36ba5a53-d8cb-4d95-99cc-355d97b226ad");
    define('API_MODULE_CLIENT_SECRET', "admin");
}else{
    // APP settings for production
    defined('API_HOST_URL')         OR define('API_HOST_URL', "http://api.nbos.in/");
    defined('API_CLIENT_ID')        OR define('API_CLIENT_ID', "my-client");
    defined('API_CLIENT_SECRET')    OR define('API_CLIENT_SECRET', "my-secret");

    defined('FACEBOOK_APP_ID')        OR define('FACEBOOK_APP_ID', "510108922524128");
    defined('FACEBOOK_APP_SECRET')    OR define('FACEBOOK_APP_SECRET', "00bd5689d33289cd308ee42df3990467");

    defined('GOOGLE_CLIENT_ID')        OR define('GOOGLE_CLIENT_ID', "934148761240-7uf49nhf76jset1ad8vatqj9pdflghtj.apps.googleusercontent.com");
    defined('GOOGLE_CLIENT_SECRET')    OR define('GOOGLE_CLIENT_SECRET', "udILTlXvc3FuJ55yDN01XrLy");

    defined('INSTAGRAM_API_KEY')       OR define('INSTAGRAM_API_KEY', "0fa38988693e4dd59370a670de2bb28d");
    defined('INSTAGRAM_API_SECRET')    OR define('INSTAGRAM_API_SECRET', "2eb24d4054964079801abd68ffeca1d1");

    defined('GITHUB_OAUTH2_CLIENT_ID')     OR define('GITHUB_OAUTH2_CLIENT_ID', "ce41d07eeaf21b953585");
    defined('GITHUB_OAUTH2_CLIENT_SECRET') OR define('GITHUB_OAUTH2_CLIENT_SECRET', "d7100948b4fff75b8e73b8bab2eb43e25caa7367");

    defined('LINKEDIN_CLIENT_ID')     OR define('LINKEDIN_CLIENT_ID', "750wziffe02w19");
    defined('LINKEDIN_CLIENT_SECRET') OR define('LINKEDIN_CLIENT_SECRET', "RzNPKod8dS5lcAj8");

    defined('TWITTER_CONSUMER_KEY')    OR define('TWITTER_CONSUMER_KEY', "jTm94nxu1hC3tOrxlvlaBKVlN");
    defined('TWITTER_CONSUMER_SECRET') OR define('TWITTER_CONSUMER_SECRET', "fTiW6Irp5zyMaf1DdplryZ7fhN4AXYN0nzqZeB9xzW5j3uXODN");

    defined('CURL_DEBUG') OR define('CURL_DEBUG', false);
    define('API_MODULE_CLIENT_ID', "36ba5a53-d8cb-4d95-99cc-355d97b226ad");
    define('API_MODULE_CLIENT_SECRET', "admin");
}


