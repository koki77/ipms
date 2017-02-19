<?php
	/**
	 * dNw2Mst01
	 *  コードテーブルのコード区分指定検索
	 *  Input:
	 *		codeKb
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/19
	 */
	class dCodeMst01 extends fwDBase02
	{
		protected $sql = 'SELECT * FROM code_mst WHERE codekb = ? ORDER BY codeid';

		//Dao生成
		protected function createDao()
		{
			return(new daoCodeMst());
		}

		//検索キー設定
		public function setSelectPrm($codeId)
		{
			$this->prm = array($codeId);
		}
	}

?>
