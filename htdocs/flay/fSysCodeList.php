<?php
	/**
	 * fSysCodeList
	 *  コード一覧
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/19
	 */
	class fSysCodeList extends fwFBase01
	{
		//変数宣言
		private $codeName;
		private $codeId;
		private $codeKb;

		//初期化処理
		protected function init()
		{
			$this->codeName = array();
			$this->codeId = array();
			$this->codeKb = 0;
		}

		//値設定
		public function setCodeKb($codeKb)
		{
			$this->codeKb = $codeKb;
		}

		//明細行数取得
		public function getCount()
		{
			return(count($this->codeId));
		}

		//値取得
		public function getCodeName($idx)
		{
			return($this->codeName[$idx]);
		}

		public function getCodeId($idx)
		{
			return($this->codeId[$idx]);
		}

		//明細検索用Dlay設定
		protected function setDlay()
		{
			$this->dlay = new dCodeMst01($this->dbc);
			$this->dlay->setSelectPrm($this->codeKb);
		}

		//明細データ取得
		public function getLineData()
		{
			$this->codeId[$this->cnt] = $this->dao->getCodeId();
			$this->codeName[$this->cnt] = $this->dao->getCodeName();
		}

		//明細行初期化
		protected function initLine()
		{
			$this->codeId[$this->cnt] = 0;
			$this->codeName[$this->cnt] = "";
		}

	}
?>
