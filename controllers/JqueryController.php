<?php
/*
 * Jqueryコントローラ
 */
class JqueryController extends Controller
{
	/*
	 * 初期表示処理
	 */
	public function indexAction() {
                $this->log->write("Jquery");
		// 画面を描画
		return $this->render();
	}
	/*
	 * パララックス
	 */
	public function parallaxAction() {
                $this->log->write("Jquery_parallax");
		// 画面を描画
		return $this->render();
	}

	/*
	 * フィード
	 */
	public function feedAction() {
                $this->log->write("Jquery_feed");
		// 画面を描画
		return $this->render();
	}
}