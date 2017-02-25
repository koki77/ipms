<?php
	/**
	 * fNetNw1Display
	 *  大分類ネットワークマスタ表示
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/17
	 */
	class fNetNw1Display extends fwFBase00
	{
		//変数宣言
		private $nw1Id;
		private $nwName;
		private $nwText;
		private $dNw1;
		private $daoNw;

		public function setNw1Id($val)
		{
			$this->nw1Id = $val;
		}

		public function getNwName()
		{
			return($this->nwName);
		}

		public function getNwText()
		{
			return($this->nwText);
		}

		//初期化処理
		protected function init()
		{
			$this->nw1Id = 0;
			$this->nwName = "";
			$this->nwText = "";
		}

		//大分類ネットワーク取得
		protected function getData()
		{
			//DB検索
			$this->dNw1 = new dNw1Mst00($this->dbc);
			$this->dNw1->setSelectPrm($this->nw1Id);
			$this->daoNw1 = $this->dNw1->select();
			//データ設定
			$this->nwName = $this->daoNw1->getNwName();
			$this->nwText = $this->daoNw1->getNwText();
		}
	}
?>
