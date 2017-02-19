<?php
	/**
	 * fNetNw2Add
	 *  小分類ネットワークマスタ追加
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/19
	 */
	class fNetNw2Add extends fwFBase20
	{
		//変数宣言
		protected $insertMsg = "NET007";
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
			if($this->nwName == "")
			{
				$this->msg = getMsg($this->dbc,"NET009");
				return(false);
			}

			if(checkName($this->nwName) == false)
			{
				$this->msg = getMsg($this->dbc,"NET009");
				return(false);
			}

			//ネットワークアドレスチェック
			if($this->addr == "")
			{
				$this->msg = getMsg($this->dbc,"NET010");
				return(false);
			}

			if(checkName($this->addr) == false)
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

		//追加データ設定
		protected function setInsertData()
		{
			$this->dlay1 = new dNw2Mst00($this->dbc);
			$this->dao1 = new daoNw2Mst();
			$this->dao1->setNw1Id($this->nw1Id);
			//ネットワークID取得
			$dNw2 = new dNw2Mst03($this->dbc);
			$daoMax = $dNw2->select();
			$this->nwId = $daoMax->getMax() + 1;
			$this->dao1->setNwId($this->nwId);
			//ソート順取得
			$dNw2 = new dNw2Mst02($this->dbc);
			$dNw2->setSelectPrm($this->nw1Id);
			$daoMax = $dNw2->select();
			$this->dao1->setSortNum($daoMax->getMax() + SortInterval);
			$this->dao1->setNwName($this->nwName);
			$this->dao1->setNwText($this->nwText);
			$this->dao1->setDelFlg(FlgFalse);
			$this->dao1->setUserId($this->uId);
			//設定情報
			$this->dao1->setNw1Id($this->nw1Id);
			$this->dao1->setDupFlg($this->dupFlg);
			$this->dao1->setAddr($this->addr);
			$this->dao1->setMask($this->mask);
			$this->dao1->setUpdateFlg(FlgTrue);
			//ユーザ情報取得
			$flayUser = new fSysUserDisplay($this->uId);
			$flayUser->setUserId($this->uId);
			$flayUser->run();
			$this->dao1->setUserName($flayUser->getUserName());
			$this->dao1->setDeptId($flayUser->getDeptId());
			$this->dao1->setDeptName($flayUser->getDeptName());

			//権限テーブル設定
			$this->dlay2 = new dNwAdminMst00($this->dbc);
			$this->dao2 = new daoNwAdminMst();
			$this->dao2->setNw1Id($this->nw1Id);
			$this->dao2->setNwId($this->nwId);
			$this->dao2->setDeptId($flayUser->getDeptId());
		}

	}
?>
