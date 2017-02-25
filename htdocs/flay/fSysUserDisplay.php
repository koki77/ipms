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
		private $sysadmin;
		private $auth01;
		private $auth02;
		private $auth03;
		private $auth04;
		private $auth05;
		private $auth06;
		private $auth07;
		private $auth08;
		private $auth09;
		private $auth10;
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

		public function getSysadmin()
		{
			return($this->sysadmin);
		}

		public function getAuth($idx)
		{
			switch($idx){
				case 1:
					return($this->auth01);
					break;
				case 2:
					return($this->auth02);
					break;
				case 3:
					return($this->auth03);
					break;
				case 4:
					return($this->auth04);
					break;
				case 5:
					return($this->auth05);
					break;
				case 6:
					return($this->auth06);
					break;
				case 7:
					return($this->auth07);
					break;
				case 8:
					return($this->auth08);
					break;
				case 9:
					return($this->auth09);
					break;
				case 10:
					return($this->auth10);
					break;
			}
		}

		//初期化処理
		protected function init()
		{
			$this->userId = "";
			$this->userName = "";
			$this->deptId = "";
			$this->deptName = "";
			$this->sysAdmin = FlgFalse;
			$this->auth01 = FlgFalse;
			$this->auth02 = FlgFalse;
			$this->auth03 = FlgFalse;
			$this->auth04 = FlgFalse;
			$this->auth05 = FlgFalse;
			$this->auth06 = FlgFalse;
			$this->auth07 = FlgFalse;
			$this->auth08 = FlgFalse;
			$this->auth09 = FlgFalse;
			$this->auth10 = FlgFalse;
		}

		//ユーザ情報取得
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
			$this->sysadmin = $this->daoUser->getSysadmin();
			$this->auth01 = $this->daoUser->getAuth01();
			$this->auth02 = $this->daoUser->getAuth02();
			$this->auth03 = $this->daoUser->getAuth03();
			$this->auth04 = $this->daoUser->getAuth04();
			$this->auth05 = $this->daoUser->getAuth05();
			$this->auth06 = $this->daoUser->getAuth06();
			$this->auth07 = $this->daoUser->getAuth07();
			$this->auth08 = $this->daoUser->getAuth08();
			$this->auth09 = $this->daoUser->getAuth09();
			$this->auth10 = $this->daoUser->getAuth10();
		}
	}
?>
