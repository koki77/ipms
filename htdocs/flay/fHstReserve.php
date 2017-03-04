<?php
	/**
	 * fHstReserve
	 *  ホスト名予約
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/03/03
	 */
	class fHstReserve extends fwFBase21
	{
		//変数宣言
		protected $insertMsg = "HST001";
		private $hostName;
		private $hostText;
		private $hostType;

		//初期化処理
		protected function init()
		{
			$this->hostName = array();
			$this->hostText = array();
		}

		//値設定
		public function sethostName($val)
		{
			$this->hostName = $val;
		}

		public function sethostText($val)
		{
			$this->hostText = $val;
		}

		public function sethostType($val)
		{
			$this->hostType = $val;
		}

		//入力チェック
		protected function inputCheck()
		{
			$max = count($this->hostName);
			$cnt = 0;
			while($max > $cnt)
			{
				//単体チェック
				if(checkSpaceStr($this->hostName[$cnt]) == true)
				{
					if(checkHostName($this->hostName[$cnt]) == false)
					{
						$this->msg = getMsg($this->dbc,"HST002")."[".$this->hostName[$cnt]."]";
						return(false);
					}
				}else{
					//半角/全角スペースのみ入力された場合の対策として初期化
					$this->hostName[$cnt] = "";
				}
				if(checkSpaceStr($this->hostText[$cnt]) == false)
				{
					//半角/全角スペースのみ入力された場合の対策として初期化
					$this->hostText[$cnt] = "";
				}
				$cnt++;
			}

			return(true);
		}

		//関連チェック
		protected function relationCheck()
		{
			//ホスト名/説明関連チェック
			$max = count($this->hostName);
			$cnt1 = 0;
			while($max > $cnt1)
			{
				if($this->hostName[$cnt1] == "")
				{
					if($this->hostText[$cnt1] != "")
					{
						$this->msg = getMsg($this->dbc,"HST003");
						return(false);
					}
				}else{
					if($this->hostText[$cnt1] == "")
					{
						$this->msg = getMsg($this->dbc,"HST003");
						return(false);
					}
				}
				$cnt1++;
			}

			//入力ホスト名重複チェック
			$cnt1 = 0;
			while($max >= $cnt1)
			{
				$cnt2 = $cnt1 + 1;
				while($max > $cnt2)
				{
					if($this->hostName[$cnt2] != "")
					{
						if($this->hostName[$cnt2] == $this->hostName[$cnt1])
						{
							$this->msg = getMsg($this->dbc,"HST004")."[".$this->hostName[$cnt1]."]";
							return(false);
						}
					}
					$cnt2++;
				}
				$cnt1++;
			}

			//登録済みホスト名チェック
			$cnt1 = 0;
			$dHst = new dHostMst02($this->dbc);
			while($max > $cnt1)
			{
				$dHst->setSelectPrm($this->hostName[$cnt1]);
				if($dHst->select() != NULL)
				{
					$this->msg = getMsg($this->dbc,"HST005")."[".$this->hostName[$cnt1]."]";
					return(false);
				}
				$cnt1++;
			}
			return(true);
		}

		//インサート件数設定
		protected function setInsertCount()
		{
			$this->insertCnt = count($this->hostName);
		}

		//追加データ設定
		protected function setInsertData()
		{
			if($this->hostName[$this->cnt] == "")
			{
				$this->insertFlg = FlgFalse;
			}else{
				$this->insertFlg = FlgTrue;
				$this->dlay = new dHostMst00($this->dbc);
				$this->dao = new daoHostMst();
				$this->dao->setHistoryNo(0);
				$this->dao->setHostName($this->hostName[$this->cnt]);
				$this->dao->setHostText($this->hostText[$this->cnt]);
				$this->dao->setHostType($this->hostType[$this->cnt]);
				$this->dao->setUserId($this->uId);
				$this->dao->setUpdateKb(HostUpdInsert);
				$this->dao->setDelFlg(FlgFalse);
				//ユーザ情報取得
				$flayUser = new fSysUserDisplay($this->uId);
				$flayUser->setUserId($this->uId);
				$flayUser->run();
				$this->dao->setUserName($flayUser->getUserName());
				$this->dao->setDeptId($flayUser->getDeptId());
				$this->dao->setDeptName($flayUser->getDeptName());
			}
		}

	}
?>
