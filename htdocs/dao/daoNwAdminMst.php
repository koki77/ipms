<?php
	/**
	 * daoNwAdminMst
	 *  ネットワーク管理権限用Data Access Object
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2017/02/18
	 */
	class daoNwAdminMst
	{
		private $nw1Id;//大分類ネットワークID
		private $nwId;//小分類ネットワークID
		private $deptId;//部署ID

		//初期処理
		public function __construct()
		{
			$this->initVal();
		}

		//値設定
		public function setNw1Id($val)
		{
			$this->nw1Id = $val;
		}

		public function setNwId($val)
		{
			$this->nwId = $val;
		}

		public function setDeptId($val)
		{
			$this->deptId = $val;
		}

		//値取得
		public function getNw1Id()
		{
			return($this->nw1Id);
		}

		public function getNwId()
		{
			return($this->nwId);
		}

		public function getDeptId()
		{
			return($this->deptId);
		}

		//初期化
		public function initVal()
		{
			$this->nw1Id = 0;
			$this->nwId = 0;
			$this->deptId = 0;
		}

		//Dao編集
		function setDao($result)
		{
			$this->setNw1Id($result["nw1_id"]);
			$this->setNwId($result["nwid"]);
			$this->setDeptId($result["deptid"]);
		}
	}
?>
