<?php
	/**
	 * daoNw2Mst
	 *  小分類ネットワークマスタ用Data Access Object
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2017/02/15
	 */
	class daoNw2Mst
	{
		private $nwId;//ネットワークID
		private $nw1Id;//大分類ネットワークID
		private $sortNum;//ソート順
		private $dupFlg;//重複フラグ
		private $nwName;//ネットワーク名
		private $nmText;//コメント
		private $addr1;//アドレス（第１オクテット）
		private $addr2;//アドレス（第２オクテット）
		private $addr3;//アドレス（第３オクテット）
		private $addr4;//アドレス（第４オクテット）
		private $mask;//ネットマスク（ビット）
		private $updateFlg;//更新フラグ（新規払い出し可否）
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
		public function setNwId($val)
		{
			$this->nwId = $val;
		}

		public function setNw1Id($val)
		{
			$this->nw1Id = $val;
		}

		public function setSortNum($val)
		{
			$this->sortNum = $val;
		}

		public function setDupFlg($val)
		{
			$this->dupFlg = $val;
		}

		public function setNwName($val)
		{
			$this->nwName = $val;
		}

		public function setNwText($val)
		{
			$this->nwText = $val;
		}

		public function setAddr1($val)
		{
			$this->addr1 = $val;
		}

		public function setAddr2($val)
		{
			$this->addr2 = $val;
		}

		public function setAddr3($val)
		{
			$this->addr3 = $val;
		}

		public function setAddr4($val)
		{
			$this->addr4 = $val;
		}

		public function setAddr($val)
		{
			$addr = explode(".",$val);
			$this->addr1 = $addr[0];
			$this->addr2 = $addr[1];
			$this->addr3 = $addr[2];
			$this->addr4 = $addr[3];
		}

		public function setMask($val)
		{
			$this->mask = $val;
		}

		public function setUpdateflg($val)
		{
			$this->updateFlgflg = $val;
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
		public function getNwId()
		{
			return($this->nwId);
		}

		public function getNw1Id()
		{
			return($this->nw1Id);
		}

		public function getSortNum()
		{
			return($this->sortNum);
		}

		public function getDupFlg()
		{
			return($this->dupFlg);
		}

		public function getNwName()
		{
			return($this->nwName);
		}

		public function getNwText()
		{
			return($this->nwText);
		}

		public function getAddr1()
		{
			return($this->addr1);
		}

		public function getAddr2()
		{
			return($this->addr2);
		}

		public function getAddr3()
		{
			return($this->addr3);
		}

		public function getAddr4()
		{
			return($this->addr4);
		}

		public function getAddr()
		{
			return(editAddr($this->addr1,$this->addr2,$this->addr3,$this->addr4));
		}

		public function getMask()
		{
			return($this->mask);
		}

		public function getDisplayMask()
		{
			return(getDispMask($this->mask));
		}

		public function getUpdateflg()
		{
			return($this->updateFlg);
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
			$this->nwId = 0;
			$this->nw1Id = 0;
			$this->sortnum = 0;
			$this->dupFlg = 0;
			$this->nwName = "";
			$this->nmText = "";
			$this->addr1 = 0;
			$this->addr2 = 0;
			$this->addr3 = 0;
			$this->addr4 = 0;
			$this->mask = 0;
			$this->updateFlg = 0;
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
			$this->setNwId($result["nwid"]);
			$this->setNw1Id($result["nw1_id"]);
			$this->setSortNum($result["sortnum"]);
			$this->setDupFlg($result["dupflg"]);
			$this->setNwName($result["nwnm"]);
			$this->setNwText($result["nwtext"]);
			$this->setAddr1($result["addr1"]);
			$this->setAddr2($result["addr2"]);
			$this->setAddr3($result["addr3"]);
			$this->setAddr4($result["addr4"]);
			$this->setMask($result["mask"]);
			$this->setUpdateFlg($result["updateflg"]);
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
