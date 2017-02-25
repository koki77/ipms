<?php
	/**
	 * fNetNw2DupCheck
	 *  小分類ネットワーク重複チェック
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/21
	 */
	class fNetNw2DupCheck extends fwFBase01
	{
		//変数宣言
		private $nwId;
		private $nw1Id;
		private $dupFlg;
		private $addr;
		private $mask;
		private $dNw2;
		private $daoNw2;
		private $addr4Start;
		private $addr4End;

		public function setNwId($val)
		{
			$this->nwId = $val;
		}

		public function setNw1Id($val)
		{
			$this->nw1Id = $val;
		}

		public function setDupFlg($val)
		{
			$this->dupFlg = $val;
		}

		public function setAddr($val)
		{
			$this->addr = $val;
		}

		public function setMask($val)
		{
			$this->mask = $val;
		}

		public function getDupCheck()
		{
			return($this->dupCheck);
		}

		//初期化処理
		protected function init()
		{
			$this->nwId = 0;
			$this->nw1Id = 0;
			$this->dupFlg = 0;
			$this->addr = "";
			$this->mask = 0;
			$this->dupCheck = FlgTrue;
			$this->addr4Start = 0;
			$this->addr4End = 0;
		}

		//基本データ編集
		protected function getData()
		{
			$addrArray = explode(".",$this->addr);
			$this->addr4Start = intval($addrArray[3]);
			$this->addr4End = getBroadCastIP($this->addr4Start,$this->mask);
		}

		//明細検索用Dlay設定
		protected function setDlay()
		{
			$addrArray = explode(".",$this->addr);
			$addr1 = intval($addrArray[0]);
			$addr2 = intval($addrArray[1]);
			$addr3 = intval($addrArray[2]);
			if($this->dupFlg == DupKbNG)
			{
				$this->dlay = new dNw2Mst04($this->dbc);
				$this->dlay->setSelectPrm($addr1,$addr2,$addr3);
			}else{
				$this->dlay = new dNw2Mst05($this->dbc);
				$this->dlay->setSelectPrm($this->nw1Id,$addr1,$addr2,$addr3);
			}
		}

		//明細データ取得
		protected function getLineData()
		{
			//同一レコードの場合は処理しない
			if($this->nwId == $this->dao->getNwId())
			{
				return;
			}

			//重複可の場合は処理しない
			if($this->dao->getDupFlg() == DupKbOK)
			{
				return;
			}

			//大分類内重複不可かつ大分類不一致の場合は処理しない
 			if($this->dao->getDupFlg() == DupKbNw1NG)
			{
				if($this->dao->getNw1Id() == $this->nw1Id)
				{
					return;
				}
			}

			//アドレス範囲重複チェック
			if($this->addr4Start < $this->dao->getAddr4())
			{
				if($this->dao->getAddr4() <= $this->addr4End)
				{
					$this->dupCheck = FlgFalse;
				}
			}else{
				if($this->addr4Start <= getBroadCastIP($this->dao->getAddr4(),$this->dao->getMask()))
				{
					$this->dupCheck = FlgFalse;
				}
			}
		}
	}
?>
