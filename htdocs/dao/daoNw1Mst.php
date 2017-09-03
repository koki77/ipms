<?php
	/**
	 * daoNw1Mst
	 *  大分類ネットワークマスタ用Data Access Object
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2017/02/16
	 */
	class daoNw1Mst
	{
		private $nw1Id;//大分類ネットワークID
		private $sortNum;//ソート順
		private $nwName;//ネットワーク名
		private $nmText;//コメント
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
		public function setNw1Id($val)
		{
			$this->nw1Id = $val;
		}

		public function setSortNum($val)
		{
			$this->sortNum = $val;
		}

		public function setNwName($val)
		{
			$this->nwName = $val;
		}

		public function setNwText($val)
		{
			$this->nwText = $val;
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
		public function getNw1Id()
		{
			return($this->nw1Id);
		}

		public function getSortNum()
		{
			return($this->sortNum);
		}

		public function getNwName()
		{
			return($this->nwName);
		}

		public function getNwText()
		{
			return($this->nwText);
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
			$this->nw1Id = 0;
			$this->sortnum = 0;
			$this->nwName = "";
			$this->nmText = "";
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
			$this->setNw1Id($result["nw1_id"]);
			$this->setSortNum($result["sortnum"]);
			$this->setNwName($result["nwnm"]);
			$this->setNwText($result["nwtext"]);
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
