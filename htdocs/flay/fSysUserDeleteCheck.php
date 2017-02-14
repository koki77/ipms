<?php
	/**
	 * fSysUserDeleteCheck
	 *  ユーザ削除事前チェック
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/15
	 */
	class fSysUserDeleteCheck extends fwFBase00
	{
		//変数宣言
		private $userId;
		private $dUser00;
		private $dUser04;
		private $daoUser;
		private $delflg;

		//値設定
		public function setUserId($val)
		{
			$this->userId = $val;
		}

		//値取得
		public function getDelFlg()
		{
			return($this->delflg);
		}

		//初期化処理
		protected function init()
		{
			$this->userId = "";
			$this->delflg = FlgTrue;
		}

		//ユーザ名取得
		protected function getData()
		{
			//DB検索
			$this->dUser00 = new dUserMst00($this->dbc);
			$this->dUser00->setSelectPrm($this->userId);
			$this->daoUser = $this->dUser00->select();
			if($this->daoUser->getSysadmin() == FlgTrue)
			{
				$this->dUser04 = new dUserMst04($this->dbc);
				if($this->dUser04->select() > 1)
				{
					$this->msg = getMsg($this->dbc,"SYS017");
				}else{
					$this->msg = getMsg($this->dbc,"SYS018");
					$this->delflg = FlgFalse;
				}
			}else{
				$this->msg = getMsg($this->dbc,"SYS017");
			}
		}
	}
?>
