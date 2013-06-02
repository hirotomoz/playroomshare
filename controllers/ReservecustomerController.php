<?php
/*
 * FreeのReserveページコントローラ
 */
class ReservecustomerController extends Controller
{
    	/*
	 * 今日のスケジュール
	 */
	public function myreserveAction() {
                $this->log->write("MYRESERVE");
                $user = $this->db_manager->get('User')->fetchByUserName('testcustomer');
                $this->session->set('user', $user);
		// 画面を描画
		return $this->render(array(
                    'user' => $user
                ));
	}
}