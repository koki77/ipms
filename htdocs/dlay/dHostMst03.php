<?php
	/**
	 * dHostMst03
	 *  ホスト名マスタのホスト名前方一致検索（未削除データ）
	 *  Input:
	 *		prefix
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2017/02/26
	 */
	class dHostMst03 extends fwDBase02
	{
		protected $sql = 'SELECT * FROM host_mst WHERE delflg = 0 and host_nm = ?\%';

		//Dao生成
		protected function createDao()
		{
			return(new daoHostMst());
		}

		//検索キー設定
		public function setSelectPrm($prefix)
		{
			$this->prm = array(mb_strtolower($prefix));
		}
	}

?>
