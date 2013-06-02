<?php
/*
 * オートロードクラス
 */
class ClassLoader
{
	protected $dirs;
	
	/*
	 * PHPにオートローダクラスを登録する処理
	 */
	public function register()
	{
		spl_autoload_register(array($this, 'loadClass'));
	}
	/*
	 * クラスファイルを読み込むフォルダを登録する処理
	 */
	public function registerDir($dir)
	{
		$this->dirs[] = $dir;
	}
	
	/*
	 * オートロードされた時に選択されたDIR内のクラスファイルの読み込みを行う処理
	 */
	public function loadClass($class)
	{
		foreach ($this->dirs as $dir){
			$file = $dir . '/' .$class . '.php';
			if (is_readable($file)){
				require $file;
				
				return;
			}
		}
	}
}