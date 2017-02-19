<?php
	/**
	 * dNw2Mst00
	 *  小分類ネットワークマスタへの主キーアクセス
	 *  Input:
	 *		nwId
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/18
	 */
	class dNw2Mst00 extends fwDBase00
	{
		protected $sqls = "SELECT * FROM nw2_mst WHERE nwid = ?";
		protected $sqli = "INSERT INTO nw2_mst VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,now(),?,?,?,?,now())";
		protected $sqlu = "UPDATE nw2_mst set nwid = ?,nw1_id = ?,sortnum = ?,dupflg = ?,nwnm = ?,nwtext = ?,addr1 = ?,addr2 = ?,addr3 = ?,addr4 = ?,mask = ?,updateflg = ?,delflg = ?,update_userid = ?,update_usernm = ?,update_deptid = ?,update_deptnm = ?,update_date = now() WHERE nwid = ?";
		protected $sqld = "DELETE FROM nw2_mst WHERE nwid = ?";

		//Dao生成
		protected function createDao()
		{
			return(new daoNw2Mst());
		}

		//検索キー設定
		public function setSelectPrm($nwid)
		{
			$this->prms = array($nwid);
		}

		//追加データ設定
		public function setInsertPrm($dao)
		{
			$this->prmi = array($dao->getNwId(),$dao->getNw1Id(),$dao->getSortNum(),$dao->getDupFlg(),$dao->getNwName(),$dao->getNwText(),$dao->getAddr1(),$dao->getAddr2(),$dao->getAddr3(),$dao->getAddr4(),$dao->getMask(),$dao->getUpdateFlg(),$dao->getDelFlg(),$dao->getCreateUserId(),$dao->getCreateUserName(),$dao->getCreateDeptId(),$dao->getCreateDeptName(),$dao->getUpdateUserId(),$dao->getUpdateUserName(),$dao->getUpdateDeptId(),$dao->getUpdateDeptName());
		}

		//更新データ設定
		public function setUpdatePrm($dao)
		{
			$this->prmu = array($dao->getNwId(),$dao->getNw1Id(),$dao->getSortNum(),$dao->getDupFlg(),$dao->getNwName(),$dao->getNwText(),$dao->getAddr1(),$dao->getAddr2(),$dao->getAddr3(),$dao->getAddr4(),$dao->getMask(),$dao->getUpdateFlg(),$dao->getDelFlg(),$dao->getUpdateUserId(),$dao->getUpdateUserName(),$dao->getUpdateDeptId(),$dao->getUpdateDeptName(),$dao->getNwId());
		}

		//削除キー設定
		public function setDeletePrm($nwid)
		{
			$this->prmd = array($nwid);
		}
	}
?>
