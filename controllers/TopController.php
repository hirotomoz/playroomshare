<?php
/*
 * TOPページコントローラ
 */
class TopController extends Controller
{
	/*
	 * 初期表示処理
	 */
	public function indexAction() {
                $this->log->write("TOP");
		// 画面を描画
		return $this->render();
	}
}