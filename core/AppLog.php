<?php
require_once(LOG4PHP_DIR . '/Logger.php');

/**
 * AppLog
 */
class AppLog
{
    protected $logger;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        Logger::configure(LOG4PHP_CONFIGURATION); 
    }


    /**
     * ログ書き込み
     */
    public function write($msg, $log_level=LOG_LV_INFO)
    {
        // TODO Log LevelによりLoggerを切り替える。など。
        $this->logger = Logger::getLogger(LOG_LOGGER_FILE); 

        // 呼び出し元情報の取得
        $tracearray = debug_backtrace();

        if ( isset($tracearray[0]) ){
            $fn = isset($tracearray[0]["file"]) ? (string)$tracearray[0]["file"] : "";
            $ln = isset($tracearray[0]["line"]) ? (int) $tracearray[0]["line"] : "";
            $ip = isset($_SERVER["REMOTE_ADDR"]) ? (string)$_SERVER["REMOTE_ADDR"] : "";
        }

        $fn = strlen($fn) <= 0 ? "[file no set]" : $fn;
        $ln = strlen($ln) <= 0 ? "[line no set]" : $ln;
        $ip = strlen($ip) <= 0 ? "[ip no set]" : $ip;
        // 出力メッセージの編集
        //$sp     = "\t";
        $sp     = " ";
        $str = "[" .$ip . "]" . $sp . $msg . $sp . $fn . "(" . $ln . ")";

        if ($log_level == LOG_LV_DEBUG) {
            if ($this->logger->isDebugEnabled()) {
                $this->logger->$log_level($str);
            }
        } else {
            $this->logger->$log_level($str);
        }
    }


    /**
     * デストラクタ(シャットダウン)
     */
    public function __destruct()
    {
        Logger::shutdown();
    }

}
?>
