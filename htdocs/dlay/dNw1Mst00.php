<?php
	/**
	 * dNw1Mst00
	 *  大分類ネットワークマスタへの主キーアクセス
	 *  Input:
	 *		nw1Id
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/17
	 */
	class dNw1Mst00 extends fwDBase00
	{
		protected $sqls = "SELECT * FROM nw1_mst WHERE nw1_id = ?";
		protected $sqli = "INSERT INTO nw1_mst VALUES (?,?,?,?,?,?,?,?,?,now(),?,?,?,?,now())";
		protected $sqlu = "UPDATE nw1_mst set nw1_id = ?,sortnum = ?,nwnm = ?,nwtext = ?,delflg = ?,update_userid = ?,update_usernm = ?,update_deptid = ?,update_deptnm = ?,update_date = now() WHERE nw1_id = ?";
		protected $sqld = "DELETE FROM nw1_mst WHERE nw1_id = ?";

		//Dao生成
		protected function createDao()
		{
			return(new daoNw1Mst());
		}

		//検索キー設定
		public function setSelectPrm($nw1id)
		{
			$this->prms = array($nw1id);
		}

		//追加データ設定
		public function setInsertPrm($dao)
		{
			$this->prmi = array($dao->getNw1Id(),$dao->getSortNum(),$dao->getNwName(),$dao->getNwText(),$dao->getDelFlg(),$dao->getCreateUserId(),$dao->getCreateUserName(),$dao->getCreateDeptId(),$dao->getCreateDeptName(),$dao->getUpdateUserId(),$dao->getUpdateUserName(),$dao->getUpdateDeptId(),$dao->getUpdateDeptName());
		}

		//更新データ設定
		public function setUpdatePrm($dao)
		{
			$this->prmu = array($dao->getNw1Id(),$dao->getSortNum(),$dao->getNwName(),$dao->getNwText(),$dao->getDelFlg(),$dao->getUpdateUserId(),$dao->getUpdateUserName(),$dao->getUpdateDeptId(),$dao->getUpdateDeptName(),$dao->getNw1Id());
		}

		//削除キー設定
		public function setDeletePrm($nw1id)
		{
			$this->prmd = array($nw1id);
		}
	}
?>
