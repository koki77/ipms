<?php
	/**
	 * fSysUserDisplay
	 *  ユーザ表示
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/04
	 */
	class fSysUserDisplay extends fwFBase00
	{
		//変数宣言
		private $userId;
		private $userName;
		private $deptId;
		private $deptName;
		private $dUser;
		private $daoUser;
		private $dDept;
		private $daoDept;

		public function setUserId($user)
		{
			$this->userId = $user;
		}

		public function getUserName()
		{
			return($this->userName);
		}

		public function getDisplayUserName()
		{
			if($this->deptName == "")
			{
				return($this->userName);
			}else{
				return($this->deptName."　".$this->userName);
			}
		}

		public function getDeptId()
		{
			return($this->deptId);
		}

		public function getDeptName()
		{
			return($this->deptName);
		}

		//初期化処理
		protected function init()
		{
			$this->userId = "";
			$this->userName = "";
			$this->deptId = "";
			$this->deptName = "";
		}

		//ユーザ名取得
		protected function getData()
		{
			//DB検索
			$this->dUser = new dUserMst00($this->dbc);
			$this->dUser->setSelectPrm($this->userId);
			$this->daoUser = $this->dUser->select();
			$this->dDept = new dDeptMst00($this->dbc);
			$this->dDept->setSelectPrm($this->daoUser->getDeptId());
			$this->daoDept = $this->dDept->select();
			//データ設定
			$this->userName = $this->daoUser->getUserNm();
			$this->deptId = $this->daoUser->getDeptId();
			if($this->daoDept <> null)
			{
				$this->deptName = $this->daoDept->getDeptNm();
			}
		}
	}
?>
