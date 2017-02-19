<?php
	/**
	 * fSysLogin
	 *  ログイン認証機能
	 *  ユーザIDとパスワードの判定処理
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/04
	 */
	class fSysLogin
	{
		//変数宣言
		private $userId;
		private $passWd;
		private $msg;
		private $result;
		private $dbc;
		private $dUserMst00;
		private $daoUserMst;

		public function __construct()
		{
			$this->userId = "";
			$this->passWd = "";
			$this->msg = "";
			$this->result = false;
			$this->dbc = new dDbCtl();
		}

		public function setUserId($user)
		{
			$this->userId = $user;
		}

		public function setPassword($pass)
		{
			$this->passWd = $pass;
		}

		public function run()
		{
			if($this->inputCheck() == true)
			{
				$this->passWdCheck();
			}
			$this->dbc->Commit();
		}

		//入力チェック
		private function inputCheck()
		{
			//単体チェック
			if($this->userId == "")
			{
				$this->msg = getMsg($this->dbc,"SYS010");
				return(false);
			}

			if(checkAscii($this->userId) == false)
			{
				$this->msg = getMsg($this->dbc,"SYS011");
				return(false);
			}

			if($this->passWd == "")
			{
				$this->msg = getMsg($this->dbc,"SYS012");
				return(false);
			}

			if(checkAscii($this->passWd) == false)
			{
				$this->msg = getMsg($this->dbc,"SYS013");
				return(false);
			}

			return(true);
		}

		//パスワードチェック
		private function passWdCheck()
		{
			$this->dUserMst00 = new dUserMst00($this->dbc);
			$this->dUserMst00->setSelectPrm($this->userId);
			$this->daoUserMst = $this->dUserMst00->select();
			if($this->daoUserMst == null)
			{
				$this->msg = getMsg($this->dbc,"SYS001");
			}else{
				if($this->daoUserMst->getPassWd() == $this->passWd  && $this->daoUserMst->getDelFlg() == FlgFalse)
				{
					$this->result = true;
					authoritySet($this->daoUserMst);
				}else{
					$this->result = false;
					$this->msg = getMsg($this->dbc,"SYS001");
				}
			}
		}

		//画面表示用メッセージ取得
		public function getMessage()
		{
			return($this->msg);
		}

		//認証結果取得(true=成功/false=失敗)
		public function getResult()
		{
			return($this->result);
		}
	}
?>
