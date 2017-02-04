<?php
	/**
	 * dMsg00
	 *  メッセージテーブルへの主キーアクセス
	 *  Input:
	 *		msgId
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * version     v 1.00 2016/02/04
	 */
	class dMsg00 extends fwDBase00
	{
		protected $sqls = "SELECT * FROM msg WHERE msgid = ?";
		protected $sqli = "INSERT INTO msg VALUES (?,?)";
		protected $sqlu = "UPDATE msg set msgid = ?, msg = ? WHERE msgid = ?";
		protected $sqld = "DELETE FROM msg WHERE msgid = ?";

		//Dao����
		protected function createDao()
		{
			return(new daoMsg());
		}

		//�����L�[�ݒ�
		public function setSelectPrm($msgid)
		{
			$this->prms = array($msgid);
		}

		//�ǉ��f�[�^�ݒ�
		public function setInsertPrm($dao)
		{
			$this->prmi = array($dao->getMsgId(),$dao->getMsg());
		}

		//�X�V�f�[�^�ݒ�
		public function setUpdatePrm($dao)
		{
			$this->prmu = array($dao->getMsgId(),$dao->getMsg(),$dao->getMsgId());
		}

		//�폜�L�[�ݒ�
		public function setDeletePrm($msgid)
		{
			$this->prmd = array($msgid);
		}

	}
?>
