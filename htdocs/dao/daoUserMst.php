<?php
	/**
	 * daoUserMst
	 *  ユーザーマスタ用Data Access Object
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * version     v 1.00 2016/02/04
	 */
	class daoUserMst
	{
		private $userid;//ユーザＩＤ
		private $passwd;//パスワード
		private $deptid;//部署コード
		private $usernm;//ユーザ名
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
			$this->delflg = "";
		}

		//Dao編集
		function setDao($result)
		{
			$this->setUserId($result["userid"]);
			$this->setPassWdBase64($result["passwd"]);
			$this->setDeptId($result["deptid"]);
			$this->setUserNm($result["usernm"]);
			$this->setDelflg($result["delflg"]);
		}
	}
?>
