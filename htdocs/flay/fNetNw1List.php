<?php
	/**
	 * fNetNw1List
	 *  大分類ネットワークマスタ一覧
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/16
	 */
	class fNetNw1List extends fwFBase02
	{
		//変数宣言
		private $nw1Id;
		private $nwName;
		private $nwText;
		private $dspcnt;
		private $flayUser;

		//初期化処理
		protected function init()
		{
			$this->nw1Id = array();
			$this->nwName = array();
			$this->nwText = array();
			$this->dspcnt = 0;

			//ユーザ情報取得
			$this->flayUser = new fSysUserDisplay($this->uId);
			$this->flayUser->setUserId($this->uId);
			$this->flayUser->run();
		}

		//明細行数取得
		public function getCount()
		{
			return(count($this->nw1Id));
		}

		//値取得
		public function getNw1Id($idx)
		{
			return($this->nw1Id[$idx]);
		}

		public function getNwName($idx)
		{
			return($this->nwName[$idx]);
		}

		public function getNwText($idx)
		{
			return($this->nwText[$idx]);
		}

		//明細検索用Dlay設定
		protected function setDlay()
		{
			$this->dlay = new dNw1Mst01($this->dbc);
		}

		//明細データ取得
		protected function getLineData()
		{
			$this->nw1Id[$this->dspcnt] = $this->dao->getNw1Id();
			$this->nwName[$this->dspcnt] = $this->dao->getNwName();
			$this->nwText[$this->dspcnt] = $this->dao->getNwText();
			$this->dspcnt++;
		}

		//明細行初期化
		protected function initLine()
		{
			$this->nwId[$this->dspcnt] = 0;
			$this->nwName[$this->dspcnt] = "";
			$this->nwText[$this->dspcnt] = "";
		}

		//明細データ取り込みチェック
		protected function checkLineData()
		{
			if($this->flayUser->getSysadmin() == FlgTrue)
			{
				return(true);
			}else{
				$dNwAdmin = new dNwAdminMst00($this->dbc);
				$dNwAdmin->setSelectPrm($this->dao->getNw1Id(),0,$this->flayUser->getDeptId());
				if($dNwAdmin->select() == NULL)
				{
					return(false);
				}else{
					return(true);
				}
			}
		}

	}
?>
