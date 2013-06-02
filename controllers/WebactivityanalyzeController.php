<?php
/*
 * Webactivityanalyzeコントローラ
 */
class WebactivityanalyzeController extends Controller
{
	/*
	 * 初期表示処理
	 */
	public function indexAction() {
                $this->log->write("WebActivityanAlyze");
		// 画面を描画
		return $this->render();
	}
}