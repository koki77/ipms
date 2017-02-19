<?php
	/**
	 * dNw2Mst02
	 *  小分類ネットワークマスタのソート順最大値取得（未削除データ）
	 *  Input:
	 *		nw1_id
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/18
	 */
	class dNw2Mst02 extends fwDBase51
	{
		protected $sql = 'SELECT max(sortnum) as maxval FROM nw2_mst WHERE delflg = 0 and nw1_id = ?';

		//Dao生成
		protected function createDao()
		{
			return(new daoMax01());
		}

		//検索キー設定
		public function setSelectPrm($nw1Id)
		{
			$this->prm = array($nw1Id);
		}
	}

?>
