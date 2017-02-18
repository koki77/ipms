<?php
	/**
	 * fNetNw1Add
	 *  大分類ネットワークマスタ追加
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/17
	 */
	class fNetNw1Add extends fwFBase20
	{
		//変数宣言
		protected $insertMsg = "NET001";
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

		//追加データ設定
		protected function setInsertData()
		{
			$this->dlay1 = new dNw1Mst00($this->dbc);
			$this->dao1 = new daoNw1Mst();
			//ネットワークID取得
			$dNw1 = new dNw1Mst03($this->dbc);
			$daoMax = $dNw1->select();
			$this->nw1Id = $daoMax->getMax() + 1;
			$this->dao1->setNw1Id($this->nw1Id);
			//ソート順取得
			$dNw1 = new dNw1Mst02($this->dbc);
			$daoMax = $dNw1->select();
			$this->dao1->setSortNum($daoMax->getMax() + SortInterval);
			$this->dao1->setNwName($this->nwName);
			$this->dao1->setNwText($this->nwText);
			$this->dao1->setDelFlg(FlgFalse);
			$this->dao1->setUserId($this->uId);
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
			$this->dao2->setNwId(0);
			$this->dao2->setDeptId($flayUser->getDeptId());
		}

	}
?>
