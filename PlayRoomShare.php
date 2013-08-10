<?php
/*
 * PlayRoomShareのアプリケーション子クラス
 */
class PlayRoomShare extends Application
{
	protected $login_action = array('account', 'signin');
	
	/*
	 * ルートディレクトリを取得
	 */
	public function getRootDir()
	{
		return dirname(__FILE__);
	}
	/*
	 * ルーティング定義配列を返却。この時点では空でいい。
	 */
	//protected function registerRoutes()
	public function registerRoutes()
	{
		return array(
			'/'
				=> array('controller' => 'top', 'action' => 'index'),
                        /* フリーコンテンツ */
			'/free'
				=> array('controller' => 'free', 'action' => 'index'),
//			'/free/:action'
//				=> array('controller' => 'free'),
                        /* フリーコンテンツ 予約システム　スタッフ*/
			'/free/reserve/staff'
				=> array('controller' => 'reservestaff', 'action' => 'schedule'),
			'/free/reserve/staff/:action'
				=> array('controller' => 'reservestaff'),
                        /* フリーコンテンツ 予約システム　顧客*/
			'/free/reserve/customer'
				=> array('controller' => 'reservecustomer', 'action' => 'myreserve'),
			'/free/reserve/customer/:action'
				=> array('controller' => 'reservecustomer'),
                        /* WEBアクセス解析 */
			'/free/webactivityanalyze'
				=> array('controller' => 'webactivityanalyze', 'action' => 'index'),
			'/free/webactivityanalyze/:action'
				=> array('controller' => 'webactivityanalyze'),
                        /* jQuery */
			'/free/jquery/:action'
				=> array('controller' => 'jquery'),
                        /* メンテナンス画面 */
			'/maintenance'
				=> array('controller' => 'maintenance', 'action' => 'index'),
		);
	}
	/*
	 * アプリケーションの設定。DBの接続設定。
	 */
	protected function configure()
	{
		$this->db_manager->connect('master', array(
			'dsn'      => 'mysql:dbname=playroomshare;host=localhost',
			'user'     => 'tzama',
			'password' => '1019hsnk',
		));
	}
}