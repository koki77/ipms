<?php
	/**
	 * dModelMst00
	 *  機種名マスタへの主キーアクセス
	 *  Input:
	 *		modelId
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2017/04/02
	 */
	class dModelMst00 extends fwDBase00
	{
		protected $sqls = "SELECT * FROM model_mst WHERE model_id = ?";
		protected $sqli = "INSERT INTO model_mst VALUES (?,?,?,?,?,?,?,?,?,?,now(),?,?,?,?,now())";
		protected $sqlu = "UPDATE model_mst set model_id = ?,model_nm = ?,model_weight = ?,machine_type = ?,unit_size = ?,delflg = ?,update_userid = ?,update_usernm = ?,update_deptid = ?,update_deptnm = ?,update_date = now() WHERE model_id = ?";
		protected $sqld = "DELETE FROM model_mst WHERE model_id = ?";

		//Dao生成
		protected function createDao()
		{
			return(new daoModelMst());
		}

		//検索キー設定
		public function setSelectPrm($modelid)
		{
			$this->prms = array($modelid);
		}

		//追加データ設定
		public function setInsertPrm($dao)
		{
			$this->prmi = array($dao->getModelId(),$dao->getModelName(),$dao->getModelWeight(),$dao->getMachineType(),$dao->getUnitSize(),$dao->getDelFlg(),$dao->getCreateUserId(),$dao->getCreateUserName(),$dao->getCreateDeptId(),$dao->getCreateDeptName(),$dao->getUpdateUserId(),$dao->getUpdateUserName(),$dao->getUpdateDeptId(),$dao->getUpdateDeptName());
		}

		//更新データ設定
		public function setUpdatePrm($dao)
		{
			$this->prmu = array($dao->getModelId(),$dao->getModelName(),$dao->getModelWeight(),$dao->getMachineType(),$dao->getUnitSize(),$dao->getDelFlg(),$dao->getUpdateUserId(),$dao->getUpdateUserName(),$dao->getUpdateDeptId(),$dao->getUpdateDeptName(),$dao->getModelId());
		}

		//削除キー設定
		public function setDeletePrm($modelid)
		{
			$this->prmd = array($modelid);
		}
	}
?>
