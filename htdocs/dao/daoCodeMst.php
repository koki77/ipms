<?php
	/**
	 * daoCodeMst
	 *  コードテーブル用Data Access Object
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/19
	 */
	class daoCodeMst
	{
		private $codeKb;//コード区分
		private $codeId;//コードＩＤ
		private $codeName;//コード名

		//初期処理
		public function __construct()
		{
			$this->initVal();
		}

		//値設定
		public function setCodeKb($val)
		{
			$this->codeKb = $val;
		}

		public function setCodeId($val)
		{
			$this->codeId = $val;
		}

		public function setCodeName($val)
		{
			$this->codeName = $val;
		}

		//値取得
		public function getCodeKb()
		{
			return($this->codeKb);
		}

		public function getCodeId()
		{
			return($this->codeId);
		}

		public function getCodeName()
		{
			return($this->codeName);
		}


		//初期化
		public function initVal()
		{
			$this->codeKb = "";
			$this->codeId = "";
			$this->codeName = "";
		}

		//Dao編集
		function setDao($result)
		{
			$this->setCodeKb($result["codekb"]);
			$this->setCodeId($result["codeid"]);
			$this->setCodeName($result["codename"]);
		}
	}


?>
