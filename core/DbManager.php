<?php
/*
 * DB管理クラス
 */
class DbManager
{
	protected $connections = array();
	protected $repository_connection_map = array();
	protected $repositories = array();
	
	/*
	 * PDOへの接続を行う処理
	 */
	public function connect($name, $params)
	{
		// キーの存在をあらかじめ設定しておく。使う時は$paramsでキーも渡す。
		$params = array_merge(array(
			'dsn'       => null,
			'user'      => '',
			'password'  => '',
			'options'   => array(),
		), $params);
		
		// PDOインスタンスの生成
		$con = new PDO(
			$params['dsn'],
			$params['user'],
			$params['password'],
			$params['options']
		);
		
		// PDO内部でエラーが起きた場合に例を発生させる設定
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$this->connections[$name] = $con;
	}
	/*
	 * 指定した名前のコネクションがあれば返す、無ければPDOインスタンスを返す処理
	 */
	public function getConnection($name = null)
	{
		if (is_null($name)){
			return current($this->connections);
		}
		
		return $this->connections[$name];
	}
	/*
	 * Repositoryクラスに対応する接続名をセット
	 */
	public function setRepositoryConnectionMap($repository_name)
	{
		$this->repository_connection_map[$repository_name];
	}

	/*
	 * Repositoryクラスに対応する接続名を取得、無ければ最初に作成したものを取得する処理
	 */
	public function getConnectionForRepository($repository_name)
	{
		if (isset($this->repository_connection_map[$repository_name])){
			$name = $this->repository_connection_map[$repository_name];
			$con = $this->getConnection($name);
		} else {
			$con = $this->getConnection();
		}
		return $con;
	}
	
	/*
	 * Repositoryクラスの管理、1度インスタンスを作ったらそれ以降インスタンス生成する必要がないようにする処理
	 */
	public function get($repository_name)
	{
		if (!isset($this->repositories[$repository_name])){
			$repository_class = $repository_name . 'Repository';
			$con = $this->getConnectionForRepository($repository_name);
			
			$repository = new $repository_class($con);
			
			$this->repositories[$repository_name] = $repository;
		}
		
		return $this->repositories[$repository_name];
	}
	
	/*
	 * DB接続の解放。Repositoryクラスとコネクションを破棄する処理
	 */ 
	public function __destruct()
	{
		foreach ($this->repositories as $repository){
			unset($repository);
		}
		
		foreach ($this->connections as $con){
			unset($con);
		}
	}
}