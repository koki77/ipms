<?php
	/**
	 * fSysPasswdUpdate
	 *  パスワード更新
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/04
	 */
	class fSysPasswdUpdate extends fwFBase11
	{
			//変数宣言
		private $userId;
		private $passWd1;
		private $passWd2;
		protected $dlay;
		protected $dao;
		protected $updateMsg = "SYS007";

		//初期化処理
		protected function init()
		{
			$this->userId = "";
			$this->passWd1 = "";
			$this->passWd2 = "";
		}

		//値設定
			public function setUserId($user)
		{
			$this->userId = $user;
		}

		public function setPassword1($pass1)
		{
			$this->passWd1 = $pass1;
		}

		public function setPassword2($pass2)
		{
			$this->passWd2 = $pass2;
		}

		//入力チェック
		protected function inputCheck()
		{
			//単体チェック
			if($this->passWd1 == "")
			{
				$this->msg = getMsg($this->dbc,"SYS012");
				return(false);
			}

			if(checkAscii($this->passWd1) == false)
			{
				$this->msg = getMsg($this->dbc,"SYS013");
				return(false);
			}

			if($this->passWd2 == "")
			{
				$this->msg = getMsg($this->dbc,"SYS012");
				return(false);
			}

			if(checkAscii($this->passWd2) == false)
			{
				$this->msg = getMsg("SYS013");
				return(false);
			}

			//関連チェック
			if($this->passWd1 <> $this->passWd2)
			{
				$this->msg = getMsg($this->dbc,"SYS005");
				return(false);
			}

			return(true);
		}

		//更新データ設定
		protected function setUpdateData()
		{
			$this->dlay = new dUserMst00($this->dbc);
			$this->dlay->setSelectPrm($this->userId);
			$this->dao = $this->dlay->select();
			$this->dao->setPassWd($this->passWd1);
		}

		//更新処理
		protected function updateProc()
		{
			$this->dlay->setUpdatePrm($this->dao);
			if($this->dlay->update() == true)
			{
				return(true);
			}else{
				return(false);
			}
		}
	}
?>
