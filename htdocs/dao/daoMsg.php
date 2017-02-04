<?php
	/**
	 * daoMsg
	 *  メッセージテーブル用Data Access Object
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/04
	 */
	class daoMsg
	{
		private $msgid;//メッセージＩＤ
		private $msg;//メッセージ

		//初期処理
		public function __construct()
		{
			$this->initVal();
		}

		//値設定
		public function setMsgId($val)
		{
			$this->msgid = $val;
		}

		public function setMsg($val)
		{
			$this->msg = $val;
		}

		//値取得
		public function getMsgId()
		{
			return($this->msgid);
		}

		public function getMsg()
		{
			return($this->msg);
		}


		//初期化
		public function initVal()
		{
			$this->msgid = "";
			$this->msg = "";
		}

		//Dao編集
		function setDao($result)
		{
			$this->setMsgId($result["msgid"]);
			$this->setMsg($result["msg"]);
		}
	}


?>
