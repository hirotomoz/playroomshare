<?php
/*
 * セッション情報管理クラス
 */
class Session
{
	protected static $sessionStarted = false;
	protected static $sessionIdRegenerated = false;
	
	/*
	 * コンストラクタ
	 * セッションが無ければスタート
	 */
	public function __construct()
	{
		if (!self::$sessionStarted){
			session_start();
			
			self::$sessionStarted = true;
		}
	}
	
	/*
	 * $_SESSIONにキーの名前を追加して値をセット
	 */
	public function set($name, $value)
	{
		$_SESSION[$name] = $value;
	}

	/*
	 * $_SESSIONから指定のキーの値を取得、無ければ$defaultを返す
	 */
	public function get($name, $default = null)
	{
		if (isset($_SESSION[$name])){
			return $_SESSION[$name];
		}
		
		return $default;
	}

	/*
	 * $_SESSIONから指定したキーを削除する
	 */
	public function remove($name)
	{
		unset($_SESSION[$name]);
	}
	
	/*
	 * $_SESSIONをクリアする
	 */
	public function clear()
	{
		$_SESSION = array();
	}
	
	/*
	 * セッションIDを新しく発行する、1度のリクエスト中に複数回呼び出されないようにする処理
	 */
	public function regenerate($destroy = true)
	{
		if (!self::$sessionIdRegenerated){
			session_regenerate_id($destroy);
			
			self::$sessionIdRegenerated = true;
		}
	}
	
	/*
	 * ログイン状態の制御用セッション情報をセットする処理
	 */
	public function setAuthenticated($bool)
	{
		$this->set('_authenticated', (bool)$bool);
		
		$this->regenerate();
	}
	
	/*
	 * ログイン状態を取得
	 */
	public function isAuthenticated()
	{
		return $this->get('_authenticated', false);
	}
}