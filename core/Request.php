<?php
/*
 * リクエストクラス
 */
class Request
{
	/*
	 * POSTかチェックする処理
	 */
	public function isPost()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST'){
			return true;
		}
		
		return false;
	}
	
	/*
	 * 指定した名前の$_GET要素の中身を返却する処理。無ければデフォルト返す。
	 */
	public function getGet($name, $default = null)
	{
		if (isset($_GET[$name])){
			return $_GET[$name];
		}
		
		return $default;
	}
	
	/*
	 * 指定した名前の$_POST要素の中身を返却する処理。無ければデフォルト返す。
	 */
	public function getPost($name, $default = null)
	{
		if (isset($_POST[$name])){
			return $_POST[$name];
		}
		
		return $default;
	}
	
	/*
	 * $_SERVERのHTTP_HOSTがあれば返却する処理。無ければデフォルトSERVER_NAMEを返す。
	 */
	public function getHost()
	{
		if (!empty($_SERVER['HTTP_HOST'])){
			return $_SERVER['HTTP_HOST'];
		}
		
		return $_SERVER['SERVER_NAME'];
	}
	
	/*
	 * SSLかチェックする処理
	 */
	public function isSsl()
	{
		if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
			return true;
		}
		
		return false;
	}
	
	/*
	 * リクエストURIを返却する処理
	 */
	public function getRequestUri()
	{
		return $_SERVER['REQUEST_URI'];
	}
	/*
	 * フロントコントローラ（index.php）までのパスを返却す処理
	 */
	public function getBaseUrl()
	{
		$script_name = $_SERVER['SCRIPT_NAME'];
		
		$request_uri = $this->getRequestUri();
		
		if (0 === strpos($request_uri, $script_name)){
			return $script_name;
		} else if (0 === strpos($request_uri, dirname($script_name))){
			return rtrim(dirname($script_name), '/');
		}
		
		return '';
	}
	
	/*
	 * フロントコントローラ（index.php）から後ろのパスを返却す処理（ファイル名やパラメータは除く）
	 */
	public function getPathInfo()
	{
		$base_url = $this->getBaseUrl();
		$request_uri = $this->getRequestUri();
		
		if (false !== ($pos = strpos($request_uri, '?'))){
			$request_uri = substr($request_uri, 0, $pos);
		}
		
		$path_info = (string)substr($request_uri, strlen($base_url));
		
		return $path_info;
		
	}
}
