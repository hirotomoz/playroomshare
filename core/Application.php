<?php
/*
 * アプリケーション全体を管理するクラス
 */
abstract class Application
{
	protected $debug = false;
	protected $request;
	protected $response;
	protected $session;
	protected $db_manager;
	protected $login_action = array();
        protected $log;
	
	/*
	 * コンストラクタ
	 * デバッグモードの設定
	 * 初期化処理
	 * 個別アプリケーション設定
	 */
	public function __construct($debug = false)
	{
		$this->setDebugMode($debug);
		$this->initialize();
		$this->configure();
	}
	
	/*
	 * デバッグモードについて設定する処理
	 * TRUEで全てのPHPエラーを表示する
	 */
	public function setDebugMode($debug)
	{
		if ($debug){
			$this->debug = true;
			ini_set('display_errors', 1);
			error_reporting(-1);
		} else {
			$this->debug = false;
			ini_set('display_errors', 0);
		}
	}
	
	/*
	 * 初期化処理
	 */
	protected function initialize()
	{
                $this->log      = new AppLog();
		$this->request  = new Request();
		$this->response = new Response();
		$this->session  = new Session();
		$this->db_manager = new DbManager();
		$this->router = new Router($this->registerRoutes());
	}
	
	protected function configure()
	{
		
	}
	
	abstract public function getRootDir();
	
	abstract public function registerRoutes();
	
	/*
	 * デバッグモード確認
	 */
	public function isDebugMode()
	{
		return $this->debug;
	}
	
	/*
	 * リクエストプロパティのゲッター
	 */
	public function getRequest()
	{
		return $this->request;
	}
	
	/*
	 * レスポンスプロパティのゲッター
	 */
	public function getResponse()
	{
		return $this->response;
	}

	/*
	 * セッションプロパティのゲッター
	 */
	public function getSession()
	{
		return $this->session;
	}

	/*
	 * DBマネージャプロパティのゲッター
	 */
	public function getDbManager()
	{
		return $this->db_manager;
	}
        /**
         * AppLogオブジェクトを取得
         *
         * @return AppLog
         */
        public function getAppLog()
        {
            return $this->log;
        }
        
	/*
	 * コントローラのルートディレクトリのゲッター
	 */
	public function getControllerDir()
	{
		return $this->getRootDir() . '/controllers';
	}

	/*
	 * ビューのルートディレクトリのゲッター
	 */
	public function getViewDir()
	{
		return $this->getRootDir() . '/views';
	}

	/*
	 * モデルのルートディレクトリのゲッター
	 */
	public function getModelDir()
	{
		return $this->getRootDir() . '/models';
	}

	/*
	 * WEBのルートディレクトリのゲッター
	 */
	public function getWebDir()
	{
		return $this->getRootDir() . '/web';
	}
	/*
	 * コントローラを指定して、アクションを実行、画面の表示する処理
	 */
	public function run()
	{
		try {
			$params = $this->router->resolve($this->request->getPathInfo());
			if ($params === false){
				// todo-A
				throw new HttpNotFoundException('No route found for ' . $this->request->getPathInfo());
			}
			
			$controller = $params['controller'];
			$action = $params['action'];
			
			$this->runAction($controller, $action, $params);
		} catch (HttpNotFoundException $e){
			$this->render404Page($e);
		} catch (UnauthorizedActionException $e){
		// ログインされていない場合の処理
			list($controller, $action) = $this->login_action;
			$this->runAction($controller, $action);
		}
		
		$this->response->send();
	}
	
	/*
	 * コントローラを探し、アクションを実行、画面表示内容をセットする処理
	 */
	public function runAction($controller_name, $action, $params = array())
	{
		$controller_class = ucfirst($controller_name) . 'Controller';
		
		$controller = $this->findController($controller_class);
		if ($controller === false){
			// todo-B
			throw new HttpNotFoundException($controller_class . ' controller is not found.');
		}
		
		$content = $controller->run($action, $params);
		
		$this->response->setContent($content);
	}
	
	/*
	 * コントローラクラスが読み込まれていない時に、クラスファイルを読み込みコントローラクラスを生成
	 * コントローラクラスのコンストラクタにこのApplicationクラス自身を渡す処理
	 */
	protected function findController($controller_class)
	{
		if (!class_exists($controller_class)){
			$controller_file = $this->getControllerDir() . '/' . $controller_class . '.php';

			if (!is_readable($controller_file)){
				return false;
			} else {
				require_once $controller_file;
				
				if (!class_exists($controller_class)){
					return false;
				}
			}
		}
		
		return new $controller_class($this);
		
	}

	/*
	 * Not Found ページ処理
	 */
	protected function render404Page($e)
	{
		$this->response->setStatusCode(404, 'Not Found');
		$message = $this->isDebugMode() ? $e->getMessage() : 'Page not found.';
		$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
		
		$this->response->setContent(<<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>404</title>
</head>
<body>
	{$message}
</body>
</html>
EOF
		);
	}
}