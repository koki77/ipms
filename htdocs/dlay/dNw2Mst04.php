<?php
	/**
	 * dNw2Mst04
	 *  小分類ネットワークマスタの全体検索（重複チェック用）
	 *  Input:
	 *		addr1,addr2,addr3
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/21
	 */
	class dNw2Mst04 extends fwDBase02
	{
		protected $sql = 'SELECT * FROM nw2_mst WHERE delflg = 0 and addr1 = ? and addr2 = ? and addr3 =?';

		//Dao生成
		protected function createDao()
		{
			return(new daoNw2Mst());
		}

		//検索キー設定
		public function setSelectPrm($addr1,$addr2,$addr3)
		{
			$this->prm = array($addr1,$addr2,$addr3);
		}
	}

?>
