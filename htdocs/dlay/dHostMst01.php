<?php
	/**
	 * dHostMst01
	 *  ホスト名マスタへの履歴更新
	 *  Input:
	 *		hostId
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/26
	 */
	class dHostMst01 extends fwDBase10
	{
		protected $sql = "UPDATE host_mst set delflg = 2 WHERE host_id = ? and history_no = ?";

		//更新データ設定
		public function setUpdatePrm($hostId,$historyNo)
		{
			$this->prm = array($hostId,$historyNo);
		}

	}
?>
