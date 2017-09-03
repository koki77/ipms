﻿<?php
	/**
	 * daoDeptMst
	 *  部署マスタ用Data Access Object
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2017/02/04
	 */
	class daoDeptMst
	{
		private $deptid;//部署コード
		private $deptnm;//部署名
		private $delflg;//削除フラグ

		//初期処理
		public function __construct()
		{
			$this->initVal();
		}

		//値設定
		public function setDeptNm($val)
		{
			$this->deptnm = $val;
		}

		public function setDeptId($val)
		{
			$this->deptid = $val;
		}

		public function setDelflg($val)
		{
			$this->delflg = $val;
		}

		//値取得
		public function getDeptId()
		{
			return($this->deptid);
		}

		public function getDeptNm()
		{
			return($this->deptnm);
		}

		public function getDelflg()
		{
			return($this->delflg);
		}

		//初期化
		public function initVal()
		{
			$this->deptid = 0;
			$this->deptnm = "";
			$this->delflg = FlgTrue;
		}

		//Dao編集
		function setDao($result)
		{
			$this->setDeptId($result["deptid"]);
			$this->setDeptNm($result["deptnm"]);
			$this->setDelflg($result["delflg"]);
		}
	}
?>
