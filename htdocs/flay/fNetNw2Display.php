<?php
	/**
	 * fNetNw2Display
	 *  小分類ネットワークマスタ表示
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/21
	 */
	class fNetNw2Display extends fwFBase00
	{
		//変数宣言
		private $nwId;
		private $dupFlg;
		private $dspDupFlg;
		private $nwName;
		private $nmText;
		private $addr;
		private $mask;
		private $dspMask;
		private $dNw2;
		private $daoNw2;

		public function setNwId($val)
		{
			$this->nwId = $val;
		}

		public function getDupFlg()
		{
			return($this->dupFlg);
		}

		public function getDisplayDupFlg()
		{
			return($this->dspDupFlg);
		}

		public function getNwName()
		{
			return($this->nwName);
		}

		public function getNwText()
		{
			return($this->nwText);
		}

		public function getAddr()
		{
			return($this->addr);
		}

		public function getMask()
		{
			return($this->mask);
		}

		public function getDisplayMask()
		{
			return($this->dspMask);
		}

		//初期化処理
		protected function init()
		{
			$this->nwId = 0;
			$this->dupFlg = 0;
			$this->dspDupFlg = 0;
			$this->nwName = "";
			$this->nwText = "";
			$this->addr = "";
			$this->mask = 0;
			$this->dspMask = 0;
		}

		//小分類ネットワーク取得
		protected function getData()
		{
			//DB検索
			$this->dNw2 = new dNw2Mst00($this->dbc);
			$this->dNw2->setSelectPrm($this->nwId);
			$this->daoNw2 = $this->dNw2->select();
			//データ設定
			$this->dupFlg = $this->daoNw2->getDupFlg();
			$dCode = new dCodeMst00($this->dbc);
			$dCode->setSelectPrm(1,$this->daoNw2->getDupFlg());
			$daoCode = $dCode->select();
			$this->dspDupFlg = $daoCode->getCodeName();
			$this->nwName = $this->daoNw2->getNwName();
			$this->nwText = $this->daoNw2->getNwText();
			$this->addr = $this->daoNw2->getAddr();
			$this->mask = $this->daoNw2->getMask();
			$dCode->setSelectPrm(2,$this->daoNw2->getMask());
			$daoCode = $dCode->select();
			$this->dspDupFlg = $daoCode->getCodeName();
		}
	}
?>
