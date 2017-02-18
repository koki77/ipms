<?php
	/**
	 * fNetNw1ListUpdate
	 *  大分類ネットワークマスタ更新
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/18
	 */
	class fNetNw1Update extends fwFBase11
	{
		//変数宣言
		private $nw1Id;
		private $nwName;
		private $nwText;

		//初期化処理
		protected function init()
		{
			$this->nw1Id = 0;
			$this->nwName = "";
			$this->nwText = "";
		}

		//値設定
		public function setNw1Id($val)
		{
			$this->nw1Id = $val;
		}

		public function setNwName($val)
		{
			$this->nwName = $val;
		}

		public function setNwText($val)
		{
			$this->nwText = $val;
		}

		//入力チェック
		protected function inputCheck()
		{
			//単体チェック
			if($this->nwName == "")
			{
				$this->msg = getMsg($this->dbc,"NET003");
				return(false);
			}

			if(checkName($this->nwName) == false)
			{
				$this->msg = getMsg($this->dbc,"NET003");
				return(false);
			}

			return(true);
		}

		//関連チェック
		protected function relationCheck()
		{
			//データ存在チェック
			$dlayChk = new dNw1Mst00($this->dbc);
			$dlayChk->setSelectPrm($this->nw1Id);
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

		//更新データ設定
		protected function setUpdateData()
		{
			$this->dlay = new dNw1Mst00($this->dbc);
			$this->dao->setNwName($this->nwName);
			$this->dao->setNwText($this->nwText);
			$this->dao->setUserId($this->uId);
			//ユーザ情報取得
			$flayUser = new fSysUserDisplay($this->uId);
			$flayUser->setUserId($this->uId);
			$flayUser->run();
			$this->dao->setUserName($flayUser->getUserName());
			$this->dao->setDeptId($flayUser->getDeptId());
			$this->dao->setDeptName($flayUser->getDeptName());
		}

	}
?>
