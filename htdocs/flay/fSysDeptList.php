<?php
	/**
	 * fSysDeptList
	 *  部署一覧
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/11
	 */
	class fSysDeptList extends fwFBase01
	{
		//変数宣言
		private $deptName;
		private $deptId;
		private $prmDepId;

		//初期化処理
		protected function init()
		{
			$this->deptName = array();
			$this->deptId = array();
			$this->prmDeptId = 0;
		}

		//値設定
		public function setDeptId($deptId)
		{
			$this->prmDeptId = $deptId;
		}

		//明細行数取得
		public function getCount()
		{
			return(count($this->deptId));
		}

		//値取得
		public function getDeptName($idx)
		{
			return($this->deptName[$idx]);
		}

		public function getDeptId($idx)
		{
			return($this->deptId[$idx]);
		}

		//明細検索用Dlay設定
		protected function setDlay()
		{
			if($this->prmDeptId == DeptAll)
			{
				$this->dlay = new dDeptMst01($this->dbc);
			}else{
				$this->dlay = new dDeptMst02($this->dbc);
				$this->dlay->setSelectPrm($this->prmDeptId);
			}
		}

		//明細データ取得
		public function getLineData()
		{
			$this->deptId[$this->cnt] = $this->dao->getDeptId();
			$this->deptName[$this->cnt] = $this->dao->getDeptNm();
		}

		//明細行初期化
		protected function initLine()
		{
			$this->deptId[$this->cnt] = 0;
			$this->deptName[$this->cnt] = "";
		}

	}
?>
