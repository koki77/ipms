<?php
	/**
	 * daoHostMst
	 *  ホスト名マスタ用Data Access Object
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2017/02/25
	 */
	class daoHostMst
	{
		private $hostId;//ホストID
		private $historyNo;//履歴番号
		private $machineId;//機種ID
		private $hostName;//ホスト名
		private $hostText;//コメント
		private $hostType;//ホスト種別
		private $updateKb;//更新区分
		private $delflg;//削除フラグ
		private $createUserId;//作成ユーザID
		private $createUserName;//作成ユーザ名
		private $createDeptId;//作成部署ID
		private $createDeptName;//作成部署名
		private $createDate;//作成日時
		private $updateUserId;//更新ユーザID
		private $updateUserName;//更新ユーザ名
		private $updateDeptId;//更新部署ID
		private $updateDeptName;//更新部署名
		private $updateDate;//更新日時

		//初期処理
		public function __construct()
		{
			$this->initVal();
		}

		//値設定
		public function setHostId($val)
		{
			$this->hostId = $val;
		}

		public function setHistoryNo($val)
		{
			$this->historyNo = $val;
		}

		public function setMachineId($val)
		{
			$this->hostId = $val;
		}

		public function setHostName($val)
		{
			$this->hostName = mb_strtolower($val);
		}

		public function setHostText($val)
		{
			$this->hostText = $val;
		}

		public function setHostType($val)
		{
			$this->hostType = $val;
		}

		public function setUpdateKb($val)
		{
			$this->updateKb = $val;
		}

		public function setDelflg($val)
		{
			$this->delflg = $val;
		}

		public function setUserId($val)
		{
			$this->createUserId = $val;
			$this->updateUserId = $val;
		}

		public function setUserName($val)
		{
			$this->createUserName = $val;
			$this->updateUserName = $val;
		}

		public function setDeptId($val)
		{
			$this->createDeptId = $val;
			$this->updateDeptId = $val;
		}

		public function setDeptName($val)
		{
			$this->createDeptName = $val;
			$this->updateDeptName = $val;
		}

		private function setCreateUserId($val)
		{
			$this->createUserId = $val;
		}

		private function setCreateUserName($val)
		{
			$this->createUserName = $val;
		}

		private function setCreateDeptId($val)
		{
			$this->createDeptId = $val;
		}

		private function setCreateDeptName($val)
		{
			$this->createDeptName = $val;
		}

		private function setCreateDate($val)
		{
			$this->createDate = $val;
		}

		private function setUpdateUserId($val)
		{
			$this->updateUserId = $val;
		}

		private function setUpdateUserName($val)
		{
			$this->updateUserName = $val;
		}

		private function setUpdateDeptId($val)
		{
			$this->updateDeptId = $val;
		}

		private function setUpdateDeptName($val)
		{
			$this->updateDeptName = $val;
		}

		private function setUpdateDate($val)
		{
			$this->updateDate = $val;
		}

		//値取得
		public function getHostId()
		{
			return($this->hostId);
		}

		public function getHistoryNo()
		{
			return($this->historyNo);
		}

		public function getMachineId()
		{
			return($this->machineId);
		}

		public function getHostName()
		{
			return($this->hostName);
		}

		public function getHostText()
		{
			return($this->hostText);
		}

		public function getHostType()
		{
			return($this->hostType);
		}

		public function getUpdateKb()
		{
			return($this->updateKb);
		}

		public function getDelflg()
		{
			return($this->delflg);
		}

		public function getCreateUserId()
		{
			return($this->createUserId);
		}

		public function getCreateUserName()
		{
			return($this->createUserName);
		}

		public function getCreateDeptId()
		{
			return($this->createDeptId);
		}

		public function getCreateDeptName()
		{
			return($this->createDeptName);
		}

		public function getCreateDate()
		{
			return($this->createDate);
		}

		public function getUpdateUserId()
		{
			return($this->updateUserId);
		}

		public function getUpdateUserName()
		{
			return($this->updateUserName);
		}

		public function getUpdateDeptId()
		{
			return($this->updateDeptId);
		}

		public function getUpdateDeptName()
		{
			return($this->updateDeptName);
		}

		public function getUpdateDate()
		{
			return($this->updateDate);
		}

		//初期化
		public function initVal()
		{
			$this->hostId = 0;
			$this->historyNo = 0;
			$this->machineId = 0;
			$this->hostName = "";
			$this->hostText = "";
			$this->hostType = 0;
			$this->updateKb = 0;
			$this->delflg = FlgTrue;
			$this->createUserId = "";
			$this->createUserName = "";
			$this->createDeptId = 0;
			$this->createDeptName = "";
			$this->createDate = "";
			$this->updateUserId = "";
			$this->updateUserName = "";
			$this->updateDeptId = 0;
			$this->updateDeptName = "";
			$this->updateDate = "";
		}

		//Dao編集
		function setDao($result)
		{
			$this->setHostId($result["host_id"]);
			$this->setHistoryNo($result["history_no"]);
			$this->setMachineId($result["machine_id"]);
			$this->setHostName($result["host_nm"]);
			$this->setHostText($result["host_text"]);
			$this->setHostType($result["host_type"]);
			$this->setUpdateKb($result["update_kb"]);
			$this->setDelflg($result["delflg"]);
			$this->setCreateUserId($result["create_userid"]);
			$this->setCreateUserName($result["create_usernm"]);
			$this->setCreateDeptId($result["create_deptid"]);
			$this->setCreateDeptName($result["create_deptnm"]);
			$this->setCreateDate($result["create_date"]);
			$this->setUpdateUserId($result["update_userid"]);
			$this->setUpdateUserName($result["update_usernm"]);
			$this->setUpdateDeptId($result["update_deptid"]);
			$this->setUpdateDeptName($result["update_deptnm"]);
			$this->setUpdateDate($result["update_date"]);
		}
	}
?>
