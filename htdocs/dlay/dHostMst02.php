<?php
	/**
	 * dHostMst02
	 *  ホスト名マスタのホスト名指定検索（未削除データ）
	 *  Input:
	 *		hostName
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2017/02/26
	 */
	class dHostMst02 extends fwDBase03
	{
		protected $sql = 'SELECT * FROM host_mst WHERE delflg = 0 and host_nm = ?';

		//Dao生成
		protected function createDao()
		{
			return(new daoHostMst());
		}

		//検索キー設定
		public function setSelectPrm($hostName)
		{
			$this->prm = array(mb_strtolower($hostName));
		}
	}

?>
