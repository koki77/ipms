<?php
	/**
	 * fSysUserList
	 *  ユーザ一覧
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/04
	 */
	class fSysUserList extends fwFBase01
	{
		//変数宣言
		private $userId;
		private $deptName;
		private $userName;
		private $depId;

		//初期化処理
		protected function init()
		{
			$this->userId = array();
			$this->deptName = array();
			$this->userName = array();
			$this->deptId = 0;
		}

		//値設定
		public function setDeptId($deptId)
		{
			$this->deptId = $deptId;
		}

		//明細行数取得
		public function getCount()
		{
			return(count($this->userId));
		}

		//値取得
		public function getUserId($idx)
		{
			return($this->userId[$idx]);
		}

		public function getDeptName($idx)
		{
			return($this->deptName[$idx]);
		}

		public function getUserName($idx)
		{
			return($this->userName[$idx]);
		}

		//明細検索用Dlay設定
		protected function setDlay()
		{
			if($this->deptId == DeptAll)
			{
				$this->dlay = new dUserMst01($this->dbc);
			}else{
				$this->dlay = new dUserMst02($this->dbc);
				$this->dlay->setSelectPrm($this->deptId);
			}
		}

		//明細データ取得
		public function getLineData()
		{
			$this->userId[$this->cnt] = $this->dao->getUserId();
			$dDeptMst00 = new dDeptMst00($this->dbc);
			$dDeptMst00->setSelectPrm($this->dao->getDeptId());
			$daoDeptMst = $dDeptMst00->select();
			if($daoDeptMst <> null)
			{
				$this->deptName[$this->cnt] = $daoDeptMst->getDeptNm();
			}
			$this->userName[$this->cnt] = $this->dao->getUserNm();
		}

		//明細行初期化
		protected function initLine()
		{
			$this->userId[$this->cnt] = "";
			$this->deptName[$this->cnt] = "";
			$this->userName[$this->cnt] = "";
		}

	}
?>
