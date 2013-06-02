<?php
/*
 * ルータークラス
 */ 
class Router
{
	protected $routes;
	
	/*
	 * $routesプロパティにcompileRoutersメソッドの結果をセットする処理
	 */
	public function __construct($definitions)
	{
		$this->routes = $this->compileRouters($definitions);
	}
	
	/*
	 * 動的パラメータを正規表現でキャプチャ出来る形に変換する処理
	 */
	public function compileRouters($definitions)
	{
		$routes = array();
		
		foreach ($definitions as $url => $params){
			$tokens = explode('/', ltrim($url, '/'));
			foreach ($tokens as $i => $token){
				if (0 === strpos($token, ':')){
					$name = substr($token, 1);
					$token = '(?P<' . $name . '>[^/]+)';
				}
				$tokens[$i] = $token;
			}
			
			$pattern = '/' . implode('/', $tokens);
			$routes[$pattern] = $params;
		}
		
		return $routes;
	}
	
	/*
	 * 正規表現でキャプチャした値と、定義された値をルーティングパラメータとして格納し、返却する処理
	 */
	public function resolve($path_info)
	{
		if ('/' !== substr($path_info, 0, 1)){
			$path_info = '/' . $path_info;
		}
		foreach ($this->routes as $pattern => $params){
			if (preg_match('#^' . $pattern . '$#', $path_info, $matches)){
				$params = array_merge($params, $matches);
				
				return $params;
			}
		}
		
		return false;
	}
}