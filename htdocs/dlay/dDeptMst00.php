<?php
	/**
	 * dDeptMst00
	 *  部署マスタへの主キーアクセス
	 *  Input:
	 *		deptId
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * version     v 1.00 2016/02/04
	 */
	class dDeptMst00 extends fwDBase00
	{
		protected $sqls = "SELECT * FROM dept_mst WHERE deptid = ?";
		protected $sqli = "INSERT INTO dept_mst VALUES (?,?)";
		protected $sqlu = "UPDATE dept_mst set deptid = ?, deptnm = ?, delflg = ? WHERE deptid = ?";
		protected $sqld = "DELETE FROM dept_mst WHERE deptid = ?";

		//Dao生成
		protected function createDao()
		{
			return(new daoDeptMst());
		}

		//検索キー設定
		public function setSelectPrm($deptid)
		{
			$this->prms = array($deptid);
		}

		//追加データ設定
		public function setInsertPrm($dao)
		{
			$this->prmi = array($dao->getDeptNm(),$dao->getDelFlg());
		}

		//更新データ設定
		public function setUpdatePrm($dao)
		{
			$this->prmu = array($dao->getDeptId(),$dao->getDeptNm(),$dao->getDelFlg(),$dao->getDeptId());
		}

		//削除キー設定
		public function setDeletePrm($deptid)
		{
			$this->prmd = array($deptid);
		}
	}
?>
