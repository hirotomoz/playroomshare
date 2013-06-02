<?php
// DIRセパレータ
defined("DS") || define("DS", DIRECTORY_SEPARATOR);
// OS環境判別
if ((substr(PHP_OS, 0, 3)) === 'WIN') {
    define('ROOT_SERVER'            , 'C:\xampp\htdocs\dev' . DS);
} else {
    define('ROOT_SERVER'            , DS . 'home/tzama' . DS);
}
// パス設定
define('DIR_FW_BASE'                , ROOT_SERVER   . 'playroomshare' . DS);
define('DIR_UTILS'                  , DIR_FW_BASE   . 'utils' . DS);
define('DIR_CONFIG'                 , DIR_FW_BASE   . 'conf' . DS);

// -----------------------------------------------
// Log4php
// -----------------------------------------------
define('LOG4PHP_DIR'                , DIR_UTILS     . 'apache-log4php-2.3.0' . DS . 'src' . DS . 'main' . DS . 'php' . DS);
define('LOG4PHP_CONFIGURATION'      , DIR_CONFIG    . 'log4php.properties');

// Log Level
define('LOG_LV_DEBUG'               , 'debug');
define('LOG_LV_INFO'                , 'info');
define('LOG_LV_WARN'                , 'warn');
define('LOG_LV_ERROR'               , 'error');
define('LOG_LV_FATAL'               , 'fatal');
// Logger
define('LOG_LOGGER_FILE'            , 'www');
?>
