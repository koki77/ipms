<?php
	/**
	 * fSysUserDeptChange
	 *  ユーザー部署変更
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/12
	 */
	class fSysUserDeptChange extends fwFBase11
	{
		//変数宣言
		private $userId;
		private $deptId;
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

		//初期化処理
		protected function init()
		{
			$this->userId = "";
			$this->deptId = 0;
			$this->sysadmin = "";
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

		//値設定
		public function setUserId($val)
		{
			$this->userId = $val;
		}

		public function setDeptId($val)
		{
			$this->deptId = $val;
		}

		public function setSysadmin($val)
		{
			$this->sysadmin = $val;
		}

		public function setAuth($idx,$val)
		{
			switch($idx){
				case 1:
					$this->auth01 = $val;
					break;
				case 2:
					$this->auth02 = $val;
					break;
				case 3:
					$this->auth03 = $val;
					break;
				case 4:
					$this->auth04 = $val;
					break;
				case 5:
					$this->auth05 = $val;
					break;
				case 6:
					$this->auth06 = $val;
					break;
				case 7:
					$this->auth07 = $val;
					break;
				case 8:
					$this->auth08 = $val;
					break;
				case 9:
					$this->auth09 = $val;
					break;
				case 10:
					$this->auth10 = $val;
					break;
			}
		}

		//関連チェック
		protected function relationCheck()
		{
			//データ存在チェック
			$dlayChk = new dUserMst00($this->dbc);
			$dlayChk->setSelectPrm($this->userId);
			$this->dao = $dlayChk->select();
			if($this->dao == null)
			{
				$this->msg = getMsg($this->dbc,"SYS003");
				return(false);
			}else{
				if($this->dao->getDelFlg() == FlgTrue)
				{
					$this->msg = getMsg($this->dbc,"SYS003");
					return(false);
				}
			}

			return(true);
		}

		//追加データ設定
		protected function setUpdateData()
		{
			$this->dlay = new dUserMst00($this->dbc);
			$this->dao->setDeptId($this->deptId);
			$this->dao->setSysadmin($this->sysadmin);
			$this->dao->setAuth01($this->auth01);
			$this->dao->setAuth02($this->auth02);
			$this->dao->setAuth03($this->auth03);
			$this->dao->setAuth04($this->auth04);
			$this->dao->setAuth05($this->auth05);
			$this->dao->setAuth06($this->auth06);
			$this->dao->setAuth07($this->auth07);
			$this->dao->setAuth08($this->auth08);
			$this->dao->setAuth09($this->auth09);
			$this->dao->setAuth10($this->auth10);
		}

	}
?>
