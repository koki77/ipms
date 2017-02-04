<?php
	/**
	 * dUserMst00
	 *  ユーザマスタへの主キーアクセス
	 *  Input:
	 *		userId
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * version     v 1.00 2016/02/04
	 */
	class dUserMst00 extends fwDBase00
	{
		protected $sqls = "SELECT * FROM user_mst WHERE userid = ?";
		protected $sqli = "INSERT INTO user_mst VALUES (?,?,?,?,?)";
		protected $sqlu = "UPDATE user_mst set userid = ?, passwd = ?, deptid = ?, usernm = ?, delflg = ? WHERE userid = ?";
		protected $sqld = "DELETE FROM user_mst WHERE userid = ?";

		//Dao生成
		protected function createDao()
		{
			return(new daoUserMst());
		}

		//検索キー設定
		public function setSelectPrm($userid)
		{
			$this->prms = array($userid);
		}

		//追加データ設定
		public function setInsertPrm($dao)
		{
			$this->prmi = array($dao->getUserId(),$dao->getPassWdBase64(),$dao->getDeptId(),$dao->getUserNm(),$dao->getDelFlg());
		}

		//更新データ設定
		public function setUpdatePrm($dao)
		{
			$this->prmu = array($dao->getUserId(),$dao->getPassWdBase64(),$dao->getDeptId(),$dao->getUserNm(),$dao->getDelFlg(),$dao->getUserId());
		}

		//削除キー設定
		public function setDeletePrm($userid)
		{
			$this->prmd = array($userid);
		}
	}
?>
