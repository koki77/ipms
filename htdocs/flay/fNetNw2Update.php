<?php
	/**
	 * fNetNw2Update
	 *  小分類ネットワークマスタ更新
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/23
	 */
	class fNetNw2Update extends fwFBase11
	{
		//変数宣言
		private $nwId;
		private $nw1Id;
		private $dupFlg;
		private $nwName;
		private $nmText;
		private $addr;
		private $addrArray;
		private $mask;

		//初期化処理
		protected function init()
		{
			$this->nwId = 0;
			$this->nw1Id = 0;
			$this->dupFlg = DupKbNG;
			$this->nwName = "";
			$this->nwText = "";
			$this->addr = "";
			$this->addrArray = array();
			$this->mask = 0;
		}

		//値設定
		public function setNw1Id($val)
		{
			$this->nw1Id = $val;
		}

		public function setDupFlg($val)
		{
			$this->dupFlg = $val;
		}

		public function setNwName($val)
		{
			$this->nwName = $val;
		}

		public function setNwText($val)
		{
			$this->nwText = $val;
		}

		public function setAddr($val)
		{
			$this->addr = $val;
		}

		public function setMask($val)
		{
			$this->mask = $val;
		}

		//入力チェック
		protected function inputCheck()
		{
			//単体チェック
			//ネットワーク名チェック
			if(checkSpaceStr($this->nwName) == false)
			{
				$this->msg = getMsg($this->dbc,"NET009");
				return(false);
			}

			//ネットワークアドレスチェック
			if(checkSpaceStr($this->addr) == false)
			{
				$this->msg = getMsg($this->dbc,"NET010");
				return(false);
			}

			if(checkIpAddr($this->addr) == false)
			{
				$this->msg = getMsg($this->dbc,"NET011");
				return(false);
			}

			return(true);
		}

		//関連チェック
		protected function relationCheck()
		{
			//ネットワークアドレス妥当性チェック
			if(checkNetworkAddr($this->addr,$this->mask) == false)
			{
				$this->msg = getMsg($this->dbc,"NET012");
				return(false);
			}

			//アドレス重複チェック
			$flayCheck = new fNetNw2DupCheck($this->uId);
			$flayCheck->setNw1Id($this->nw1Id);
			$flayCheck->setNwId($this->nwId);
			$flayCheck->setDupFlg($this->dupFlg);
			$flayCheck->setAddr($this->addr);
			$flayCheck->setMask($this->mask);
			$flayCheck->run();
			if($flayCheck->getDupCheck() == FlgFalse)
			{
				$this->msg = getMsg($this->dbc,"NET013");
				return(false);
			}

			//データ存在チェック
			$dlayChk = new dNw2Mst00($this->dbc);
			$dlayChk->setSelectPrm($this->nwId);
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
		protected function setInsertData()
		{
			$this->dlay = new dNw2Mst00($this->dbc);
			$this->dao->setNwName($this->nwName);
			$this->dao->setNwText($this->nwText);
			$this->dao->setUserId($this->uId);
			//設定情報
			$this->dao->setDupFlg($this->dupFlg);
			$this->dao->setAddr($this->addr);
			$this->dao->setMask($this->mask);
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
