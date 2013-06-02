<?php
/*
 * コントローラクラス
 */
abstract class Controller
{
	protected $controller_name;
	protected $action_name;
	protected $application;
	protected $request;
	protected $response;
	protected $session;
	protected $db_manager;
	protected $auth_actions = array();
        protected $log;
	
	/*
	 * コンストラクタ
	 */
	public function __construct($application)
	{
		// class名からコントローラ名を取得
		$this->controller_name = strtolower(substr(get_class($this), 0, -10));
		
		$this->application = $application;
		$this->request     = $application->getRequest();
		$this->response    = $application->getResponse();
		$this->session     = $application->getSession();
		$this->db_manager  = $application->getDbManager();
                $this->log         = $application->getAppLog();
	}
	/*
	 * 指定のアクション（メソッド）の実行を行う処理
	 */
	public function run($action, $params = array())
	{
		$this->action_name = $action;
		
		$action_method = $action . 'Action';
		if (!method_exists($this, $action_method)){
			$this->forward404();
		}
		
		// ログイン状態チェック
		if ($this->needsAuthentication($action) && !$this->session->isAuthenticated()){
			throw new UnauthorizedActionException();
		}
		
		$content = $this->$action_method($params); // 可変関数
		
		return $content;
	}
	
	/*
	 * ビュークラスのrenderをラッピングしたrender
	 */
	protected function render($variables = array(), $template = null, $layout = 'layout')
	{
		$defaults = array(
			'request'  => $this->request,
			'base_url' => $this->request->getBaseUrl(),
			'session'  => $this->session,
		);
		
		$view = new View($this->application->getViewDir(), $defaults);
		
		// $templateがnullならアクション名をtemplateにセット
		if (is_null($template)){
			$template = $this->action_name;
		}
		
		$path = $this->controller_name . '/' . $template;
		
		return $view->render($path, $variables, $layout);
	}
	
	/*
	 * 404エラー画面表示処理
	 */
	protected function forward404()
	{
		throw new HttpNotFoundException('Forwarded 404 page from '
		 . $this->controller_name . '/' . $this->action_name);
	}
	
	/*
	 * PATH_INFOを渡してリダイレクト設定をする処理
	 */
	protected function redirect($url)
	{
		if (!preg_match('#https?://#', $url)){
			$protocol = $this->request->isSsl() ? 'https://' : 'http://';
			$host = $this->request->getHost();
			$base_url = $this->request->getBaseUrl();
			
			$url = $protocol . $host . $base_url . $url;
		}
		
		$this->response->setStatusCode(302, 'Found');
		$this->response->setHttpHeader('Location', $url);
	}
	
	/*
	 * トークンを生成し、セッションに格納する処理
	 * 生成したトークンを返却する
	 */
	protected function generateCsrfToken($form_name)
	{
		$key = 'csrf_tokens/' . $form_name;
		$tokens = $this->session->get($key, array());
		if (count($tokens) >= 10){
			array_shift($tokens);
		}
		
		// トークンの作成と格納
		$token = sha1($form_name . session_id() . microtime());
		$tokens[] = $token;
		
		$this->session->set($key, $tokens);
		
		return $token;
	}
	
	/*
	 * セッションに格納されているトークンから、POSTされたトークンを探す処理
	 */
	protected function checkCsrfToken($form_name, $token)
	{
		$key = 'csrf_tokens/' . $form_name;
		$tokens = $this->session->get($key, array());
		
		if (false !== ($pos = array_search($token, $tokens, true))){
			unset($tokens[$pos]);
			$this->session->set($key, $tokens);
			
			return true;
		}
		
		return false;
	}
	
	/*
	 * ログインが必要かどうかの判断を行う処理
	 */
	protected function needsAuthentication($action)
	{
		if ($this->auth_actions === true
		 || (is_array($this->auth_actions) && in_array($action, $this->auth_actions))
		 ){
			return true;
		}
		
		return false;
	}
}