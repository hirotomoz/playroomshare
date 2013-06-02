<?php
/*
 * ビュークラス
 */
class View
{
	protected $base_dir;
	protected $defaults;
	protected $layout_variables = array();
	
	/*
	 * コンストラクタ
	 */
	public function __construct($base_dir, $defaults = array())
	{
		$this->base_dir = $base_dir;
		$this->defaults = $defaults;
	}
	
	/*
	 * レイアウトのキーに値をセットするセッター
	 */
	public function setLayoutVar($name, $value)
	{
		$this->layout_variables[$name] = $value;
	}
	
	/*
	 * ビューファイルを読み込み、内容が文字列として格納された$contentを返却する処理
	 */
	public function render($_path, $_variables = array(), $_layout = false)
	{
		$_file = $this->base_dir . '/' . $_path . '.php';
		
		extract(array_merge($this->defaults, $_variables));
		
		// アウトプットバッファリング実行、
		// 自動フラッシュを無効に設定、
		// バッファ内容を$contentに格納
		ob_start();
		ob_implicit_flush(0);
		
		require $_file;
		
		$content = ob_get_clean();
		
		if ($_layout){
		// レイアウトの指定があればもう一度renderを実行し、 元のcontentを_contentに格納する。
			$content = $this->render($_layout,
			 array_merge($this->layout_variables, array(
			  '_content' => $content,
			 )
			));
		}
		
		return $content;
	}
	
	/*
	 * HTML特殊文字をエスケープして返却する処理
	 */
	public function escape($string)
	{
		return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	}
}