<?php
	/**
	 * dMsg00
	 *  メッセージテーブルへの主キーアクセス
	 *  Input:
	 *		msgId
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2017/02/04
	 */
	class dMsg00 extends fwDBase00
	{
		protected $sqls = "SELECT * FROM msg WHERE msgid = ?";
		protected $sqli = "INSERT INTO msg VALUES (?,?)";
		protected $sqlu = "UPDATE msg set msgid = ?, msg = ? WHERE msgid = ?";
		protected $sqld = "DELETE FROM msg WHERE msgid = ?";

		//Dao生成
		protected function createDao()
		{
			return(new daoMsg());
		}

		//検索キー設定
		public function setSelectPrm($msgid)
		{
			$this->prms = array($msgid);
		}

		//追加データ設定
		public function setInsertPrm($dao)
		{
			$this->prmi = array($dao->getMsgId(),$dao->getMsg());
		}

		//更新データ設定
		public function setUpdatePrm($dao)
		{
			$this->prmu = array($dao->getMsgId(),$dao->getMsg(),$dao->getMsgId());
		}

		//削除キー設定
		public function setDeletePrm($msgid)
		{
			$this->prmd = array($msgid);
		}

	}
?>
