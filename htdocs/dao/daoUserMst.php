<?php
	/**
	 * daoUserMst
	 *  ユーザーマスタ用Data Access Object
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/04
	 */
	class daoUserMst
	{
		private $userid;//ユーザＩＤ
		private $passwd;//パスワード
		private $deptid;//部署コード
		private $usernm;//ユーザ名
		private $sysadmin;//システム管理者権限
		private $auth01;//業務権限01
		private $auth02;//業務権限02
		private $auth03;//業務権限03
		private $auth04;//業務権限04
		private $auth05;//業務権限05
		private $auth06;//業務権限06
		private $auth07;//業務権限07
		private $auth08;//業務権限08
		private $auth09;//業務権限09
		private $auth10;//業務権限10
		private $delflg;//削除フラグ

		//初期処理
		public function __construct()
		{
			$this->initVal();
		}

		//値設定
		public function setUserId($val)
		{
			$this->userid = $val;
		}

    //未変換のパスワードを設定
		public function setPassWd($val)
		{
			$this->passwd = base64_encode($val);
		}

    //base64エンコードされたパスワードを設定
		public function setPassWdBase64($val)
		{
			$this->passwd = $val;
		}

		public function setDeptId($val)
		{
			$this->deptid = $val;
		}

		public function setUserNm($val)
		{
			$this->usernm = $val;
		}

		public function setSysadmin($val)
		{
			$this->sysadmin = $val;
		}

		public function setAuth01($val)
		{
			$this->auth01 = $val;
		}

		public function setAuth02($val)
		{
			$this->auth02 = $val;
		}

		public function setAuth03($val)
		{
			$this->auth03 = $val;
		}

		public function setAuth04($val)
		{
			$this->auth04 = $val;
		}

		public function setAuth05($val)
		{
			$this->auth05 = $val;
		}

		public function setAuth06($val)
		{
			$this->auth06 = $val;
		}

		public function setAuth07($val)
		{
			$this->auth07 = $val;
		}

		public function setAuth08($val)
		{
			$this->auth08 = $val;
		}

		public function setAuth09($val)
		{
			$this->auth09 = $val;
		}

		public function setAuth10($val)
		{
			$this->auth10 = $val;
		}

			public function setDelflg($val)
		{
			$this->delflg = $val;
		}

		//値取得
		public function getUserId()
		{
			return($this->userid);
		}

    //デコード後のパスワードを取得
		public function getPassWd()
		{
			return(base64_decode($this->passwd));
		}

    //base64エンコードされたパスワードを取得
		public function getPassWdBase64()
		{
			return($this->passwd);
		}

		public function getDeptId()
		{
			return($this->deptid);
		}

		public function getUserNm()
		{
			return($this->usernm);
		}

		public function getSysadmin()
		{
			return($this->sysadmin);
		}

		public function getAuth01()
		{
			return($this->auth01);
		}

		public function getAuth02()
		{
			return($this->auth02);
		}

		public function getAuth03()
		{
			return($this->auth03);
		}

		public function getAuth04()
		{
			return($this->auth04);
		}

		public function getAuth05()
		{
			return($this->auth05);
		}

		public function getAuth06()
		{
			return($this->auth06);
		}

		public function getAuth07()
		{
			return($this->auth07);
		}

		public function getAuth08()
		{
			return($this->auth08);
		}

		public function getAuth09()
		{
			return($this->auth09);
		}

		public function getAuth10()
		{
			return($this->auth10);
		}

		public function getDelFlg()
		{
			return($this->delflg);
		}

		//初期化
		public function initVal()
		{
			$this->userid = "";
			$this->passwd = "";
			$this->deptid = 0;
			$this->usernm = "";
			$this->sysadmin = 0;
			$this->auth01 = 0;
			$this->auth02 = 0;
			$this->auth03 = 0;
			$this->auth04 = 0;
			$this->auth05 = 0;
			$this->auth06 = 0;
			$this->auth07 = 0;
			$this->auth08 = 0;
			$this->auth09 = 0;
			$this->auth10 = 0;
			$this->delflg = FlgTrue;
		}

		//Dao編集
		function setDao($result)
		{
			$this->setUserId($result["userid"]);
			$this->setPassWdBase64($result["passwd"]);
			$this->setDeptId($result["deptid"]);
			$this->setUserNm($result["usernm"]);
			$this->setSysadmin($result["sysadmin"]);
			$this->setAuth01($result["auth01"]);
			$this->setAuth02($result["auth02"]);
			$this->setAuth03($result["auth03"]);
			$this->setAuth04($result["auth04"]);
			$this->setAuth05($result["auth05"]);
			$this->setAuth06($result["auth06"]);
			$this->setAuth07($result["auth07"]);
			$this->setAuth08($result["auth08"]);
			$this->setAuth09($result["auth09"]);
			$this->setAuth10($result["auth10"]);
			$this->setDelflg($result["delflg"]);
		}
	}
?>
