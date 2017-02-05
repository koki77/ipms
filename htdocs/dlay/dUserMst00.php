<?php
	/**
	 * dUserMst00
	 *  ユーザマスタへの主キーアクセス
	 *  Input:
	 *		userId
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/04
	 */
	class dUserMst00 extends fwDBase00
	{
		protected $sqls = "SELECT * FROM user_mst WHERE userid = ?";
		protected $sqli = "INSERT INTO user_mst VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		protected $sqlu = "UPDATE user_mst set userid = ?, passwd = ?, deptid = ?, usernm = ?, sysadmin = ?, auth01 = ?, auth02 = ?, auth03 = ?, auth04 = ?, auth05 = ?, auth06 = ?, auth07 = ?, auth08 = ?, auth09 = ?, auth10 = ?, delflg = ? WHERE userid = ?";
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
			$this->prmi = array($dao->getUserId(),$dao->getPassWdBase64(),$dao->getDeptId(),$dao->getUserNm(),$dao->getSysadmin(),$dao->getAuth01(),$dao->getAuth02(),$dao->getAuth03(),$dao->getAuth04(),$dao->getAuth05(),$dao->getAuth06(),$dao->getAuth07(),$dao->getAuth08(),$dao->getAuth09(),$dao->getAuth10(),$dao->getDelFlg());
		}

		//更新データ設定
		public function setUpdatePrm($dao)
		{
			$this->prmu = array($dao->getUserId(),$dao->getPassWdBase64(),$dao->getDeptId(),$dao->getUserNm(),$dao->getSysadmin(),$dao->getAuth01(),$dao->getAuth02(),$dao->getAuth03(),$dao->getAuth04(),$dao->getAuth05(),$dao->getAuth06(),$dao->getAuth07(),$dao->getAuth08(),$dao->getAuth09(),$dao->getAuth10(),$dao->getDelFlg(),$dao->getUserId());
		}

		//削除キー設定
		public function setDeletePrm($userid)
		{
			$this->prmd = array($userid);
		}
	}
?>
