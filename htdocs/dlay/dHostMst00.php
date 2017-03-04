<?php
	/**
	 * dHostMst00
	 *  ホスト名マスタへの主キーアクセス
	 *  Input:
	 *		hostId
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/25
	 */
	class dHostMst00 extends fwDBase00
	{
		protected $sqls = "SELECT * FROM host_mst WHERE host_id = ? and history_no = ?";
		protected $sqli1 = "INSERT INTO host_mst VALUES (?,?,?,?,?,?,?,?,?,?,?,now(),?,?,?,?,now())";
		protected $sqli2 = "INSERT INTO host_mst VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,now())";
		protected $sqlu = "UPDATE host_mst set host_id = ?,history_no = ?,host_nm = ?,host_text = ?,host_type = ?,update_kb = ?,delflg = ?,update_userid = ?,update_usernm = ?,update_deptid = ?,update_deptnm = ?,update_date = now() WHERE host_id = ? and history_no = ?";
		protected $sqld = "DELETE FROM host_mst WHERE host_id = ? and history_no = ?";

		//Dao生成
		protected function createDao()
		{
			return(new daoHostMst());
		}

		//検索キー設定
		public function setSelectPrm($hostid,$historyNo)
		{
			$this->prms = array($hostid,$historyNo);
		}

		//追加データ設定
		public function setInsertPrm($dao)
		{
			if($dao->getHistoryNo() == 1)
			{
				$this->sqli = $this->sqli1;
				$this->prmi = array($dao->getHostId(),$dao->getHistoryNo(),$dao->getHostName(),$dao->getHostText(),$dao->getHostType(),$dao->getUpdateKb(),$dao->getDelFlg(),$dao->getCreateUserId(),$dao->getCreateUserName(),$dao->getCreateDeptId(),$dao->getCreateDeptName(),$dao->getUpdateUserId(),$dao->getUpdateUserName(),$dao->getUpdateDeptId(),$dao->getUpdateDeptName());
			}else{
				$this->sqli = $this->sqli2;
				$this->prmi = array($dao->getHostId(),$dao->getHistoryNo(),$dao->getHostName(),$dao->getHostText(),$dao->getHostType(),$dao->getUpdateKb(),$dao->getDelFlg(),$dao->getCreateUserId(),$dao->getCreateUserName(),$dao->getCreateDeptId(),$dao->getCreateDeptName(),$dao->getCreateDate(),$dao->getUpdateUserId(),$dao->getUpdateUserName(),$dao->getUpdateDeptId(),$dao->getUpdateDeptName());
			}
		}

		//更新データ設定
		public function setUpdatePrm($dao)
		{
			$this->prmu = array($dao->getHostId(),$dao->getHistoryNo(),$dao->getHostName(),$dao->getHostText(),$dao->getHostType(),$dao->getUpdateKb(),$dao->getDelFlg(),$dao->getUpdateUserId(),$dao->getUpdateUserName(),$dao->getUpdateDeptId(),$dao->getUpdateDeptName(),$dao->getHostId(),$dao->getHistoryNo());
		}

		//削除キー設定
		public function setDeletePrm($hostid,$historyNo)
		{
			$this->prmd = array($hostid,$historyNo);
		}
	}
?>
