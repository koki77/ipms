<?php
	/**
	 * dNw2Mst05
	 *  小分類ネットワークマスタの大分類検索（重複チェック用）
	 *  Input:
	 *		nw1_id,addr1,addr2,addr3
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/21
	 */
	class dNw2Mst05 extends fwDBase02
	{
		protected $sql = 'SELECT * FROM nw2_mst WHERE delflg = 0 and nw1_id = ? and addr1 = ? and addr2 = ? and addr3 =?';

		//Dao生成
		protected function createDao()
		{
			return(new daoNw2Mst());
		}

		//検索キー設定
		public function setSelectPrm($nw1Id,$addr1,$addr2,$addr3)
		{
			$this->prm = array($nw1Id,$addr1,$addr2,$addr3);
		}

	}

?>
