<?php
/*
 * Maintenanceページコントローラ
 */
class MaintenanceController extends Controller
{
	/*
	 * 初期表示処理
	 */
	public function indexAction() {
                $this->log->write("MAINTE");
		// 画面を描画
		return $this->render();
	}
}