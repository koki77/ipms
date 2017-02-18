<?php
	/**
	 * dNw2Mst01
	 *  小分類ネットワークマスタの大分類指定検索（未削除データ）
	 *  Input:
	 *		nw1_id
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/18
	 */
	class dNw2Mst01 extends fwDBase01
	{
		protected $sql = 'SELECT * FROM nw1_mst WHERE delflg = 0 and nw1id = ? ORDER BY sortnum';

		//Dao生成
		protected function createDao()
		{
			return(new daoNw1Mst());
		}

		//検索キー設定
		public function setSelectPrm($nw1Id)
		{
			$this->prm = array($nw1Id);
		}
	}

?>
