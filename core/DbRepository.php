<?php
/*
 * DBリポジトリークラス
 * ※SQLの実行時に頻繁に出てくる処理の抽象化クラス
 */
abstract class DbRepository
{
	protected $con;
	
	/*
	 * コンストラクタ
	 */
	public function __construct($con)
	{
		$this->setConnection($con);
	}
	
	/*
	 * コネクションのセッター
	 */
	public function setConnection($con)
	{
		$this->con = $con;
	}
	
	/*
	 * SQL実行処理
	 * プリペアドステートメントを使っている
	 */
	public function execute($sql, $params = array())
	{
		$stmt = $this->con->prepare($sql);
		$stmt->execute($params);
		
		return $stmt;
	}
	/*
	 * SELECT結果の1行を取得する処理
	 */
	public function fetch($sql, $params = array())
	{
		return $this->execute($sql, $params)->fetch(PDO::FETCH_ASSOC);
	}
	/*
	 * SELECT結果の全ての行を取得する処理
	 */
	public function fetchAll($sql, $params = array())
	{
		return $this->execute($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
	}
}