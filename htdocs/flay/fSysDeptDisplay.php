<?php
	/**
	 * fSysDeptDisplay
	 *  部署表示
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/14
	 */
	class fSysDeptDisplay extends fwFBase00
	{
		//変数宣言
		private $deptId;
		private $deptName;
		private $dDept;
		private $daoDept;

		public function setDeptId($val)
		{
			$this->deptId = $val;
		}

		public function getDeptName()
		{
			return($this->deptName);
		}

		//初期化処理
		protected function init()
		{
			$this->deptId = "";
			$this->deptName = "";
		}

		//ユーザ名取得
		protected function getData()
		{
			//DB検索
			$this->dDept = new dDeptMst00($this->dbc);
			$this->dDept->setSelectPrm($this->deptId);
			$this->daoDept = $this->dDept->select();
			//データ設定
			$this->deptName = $this->daoDept->getDeptNm();
		}
	}
?>
