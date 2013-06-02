<?php
/*
 * FreeのReserveページコントローラ
 */
class ReservestaffController extends Controller
{
    	/*
	 * 今日のスケジュール
	 */
	public function scheduleAction() {
                $this->log->write("SCHEDULE");
		// 画面を描画
		return $this->render();
	}
}