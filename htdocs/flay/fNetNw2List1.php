<?php
	/**
	 * fNetNw2List1
	 *  小分類ネットワークマスタ一覧（管理権限判定）
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/16
	 */
	class fNetNw2List1 extends fwFBase01
	{
		//変数宣言
		private $nw1Id;
		private $nw1Name;
		private $nwId;
		private $nwName;
		private $nwText;
		private $dspAddr;
		private $authFlg;
		private $flayUser;

		//初期化処理
		protected function init()
		{
			$this->nw1Id = 0;
			$this->nw1Name = "";
			$this->nwId = array();
			$this->nwName = array();
			$this->nwText = array();
			$this->dspAddr = array();
			$this->authFlg = array();

		}

		//値設定
		public function setNw1Id($val)
		{
			$this->nw1Id = $val;
		}

		//明細行数取得
		public function getCount()
		{
			return(count($this->nwId));
		}

		//値取得
		public function getNwId($idx)
		{
			return($this->nwId[$idx]);
		}

		public function getNw1Name()
		{
			return($this->nw1Name);
		}

		public function getNwName($idx)
		{
			return($this->nwName[$idx]);
		}

		public function getNwText($idx)
		{
			return($this->nwText[$idx]);
		}

		public function getDisplayAddr($idx)
		{
			return($this->dspAddr[$idx]);
		}

		public function getAuthFlg($idx)
		{
			return($this->authFlg[$idx]);
		}

		//画面表示データ取得
		protected function getData()
		{
			//ユーザ情報取得
			$this->flayUser = new fSysUserDisplay($this->uId);
			$this->flayUser->setUserId($this->uId);
			$this->flayUser->run();

			//大分類ネットワーク名取得
			$flayNw1 = new fNetNw1Display($this->uId);
			$flayNw1->setNw1Id($this->nw1Id);
			$flayNw1->run();
			$this->nw1Name = $flayNw1->getNwName();
		}

		//明細検索用Dlay設定
		protected function setDlay()
		{
			$this->dlay = new dNw2Mst01($this->dbc);
			$this->dlay->setSelectPrm($this->nw1Id);
		}

		//明細データ取得
		protected function getLineData()
		{
			$this->nwId[$this->cnt] = $this->dao->getNwId();
			$this->nwName[$this->cnt] = $this->dao->getNwName();
			$this->nwText[$this->cnt] = $this->dao->getNwText();
			$this->dspAddr[$this->cnt] = $this->dao->getAddr()."/".$this->dao->getMask();
			if($this->flayUser->getSysadmin() == FlgTrue)
			{
				$this->authFlg[$this->cnt] = FlgTrue;
			}else{
				$dNwAdmin = new dNwAdminMst00($this->dbc);
				$dNwAdmin->setSelectPrm($this->nw1Id,$this->dao->getNwId(),$this->flayUser->getDeptId());
				if($dNwAdmin->select() == NULL)
				{
					$this->authFlg[$this->cnt] = FlgFalse;
				}else{
					$this->authFlg[$this->cnt] = FlgTrue;
				}
			}
		}

		//明細行初期化
		protected function initLine()
		{
			$this->nwId[$this->cnt] = 0;
			$this->nwName[$this->cnt] = "";
			$this->nwText[$this->cnt] = "";
			$this->dspAddr[$this->cnt] = "";
			$this->authFlg[$this->cnt] = FlgFalse;
		}

	}
?>
