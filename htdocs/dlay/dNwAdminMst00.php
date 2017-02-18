<?php
	/**
	 * dNwAdminMst00
	 *  ネットワーク管理権限への主キーアクセス
	 *  Input:
	 *		nw1Id
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/18
	 */
	class dNwAdminMst00 extends fwDBase00
	{
		protected $sqls = "SELECT * FROM nw_admin_mst WHERE nw1_id = ? and nwid = ? and deptid = ?";
		protected $sqli = "INSERT INTO nw_admin_mst (nw1_id,nwid,deptid) VALUES (?,?,?)";
		protected $sqlu = "UPDATE nw_admin_mst set nw1_id = ?,nwid = ?,deptid = ? WHERE nw1_id = ? and nwid = ? and deptid = ?";
		protected $sqld = "DELETE FROM nw_admin_mst WHERE nw1_id = ? and nwid = ? and deptid = ?";

		//Dao生成
		protected function createDao()
		{
			return(new daoNwAdminMst());
		}

		//検索キー設定
		public function setSelectPrm($nw1id,$nwid,$deptid)
		{
			$this->prms = array($nw1id,$nwid,$deptid);
		}

		//追加データ設定
		public function setInsertPrm($dao)
		{
			$this->prmi = array($dao->getNw1Id(),$dao->getNwId(),$dao->getDeptId());
		}

		//更新データ設定
		public function setUpdatePrm($dao)
		{
			$this->prmu = array($dao->getNw1Id(),$dao->getNwId(),$dao->getDeptId(),$dao->getNw1Id(),$dao->getNwId(),$dao->getDeptId());
		}

		//削除キー設定
		public function setDeletePrm($nw1id,$nwid,$deptid)
		{
			$this->prmd = array($nw1id,$nwid,$deptid);
		}
	}
?>
