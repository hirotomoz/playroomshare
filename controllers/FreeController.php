<?php
/*
 * Freeページコントローラ
 */
class FreeController extends Controller
{
	/*
	 * 初期表示処理
	 */
	public function indexAction() {
                $this->log->write("FREE");
		// 画面を描画
		return $this->render();
	}
        /*
         * 美容院予約管理
         */
	public function reserveAction($param) {
            if (count($param) !== 0){
            }
                $this->log->write("FREE/RESERVE");
		// 画面を描画
		return $this->render();
	}
}