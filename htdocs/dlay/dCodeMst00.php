<?php
	/**
	 * dCodeMst00
	 *  コードテーブルへの主キーアクセス
	 *  Input:
	 *		codeKb
	 *		codeId
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2017/02/19
	 */
	class dCodeMst00 extends fwDBase00
	{
		protected $sqls = "SELECT * FROM code_mst WHERE codekb = ? and codeid = ?";
		protected $sqli = "INSERT INTO code_mst VALUES (?,?,?)";
		protected $sqlu = "UPDATE code_mst set codekb = ?,codeid = ?, codename = ? WHERE  codekb = ? and codeid = ?";
		protected $sqld = "DELETE FROM code_mst WHERE  codekb = ? and codeid = ?";

		//Dao生成
		protected function createDao()
		{
			return(new daoCodeMst());
		}

		//検索キー設定
		public function setSelectPrm($codeKb,$codeId)
		{
			$this->prms = array($codeKb,$codeId);
		}

		//追加データ設定
		public function setInsertPrm($dao)
		{
			$this->prmi = array($dao->getCodeKb(),$dao->getCodeId(),$dao->getCodeName());
		}

		//更新データ設定
		public function setUpdatePrm($dao)
		{
			$this->prmu = array($dao->getCodeKb(),$dao->getCodeId(),$dao->getCodeName(),$dao->getCodeKb(),$dao->getCodeId());
		}

		//削除キー設定
		public function setDeletePrm($codeKb,$codeId)
		{
			$this->prmd = array($codeKb,$codeId);
		}

	}
?>
