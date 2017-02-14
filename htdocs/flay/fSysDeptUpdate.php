<?php
	/**
	 * fSysDeptUpdate
	 *  部署更新
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/15
	 */
	class fSysDeptUpdate extends fwFBase11
	{
		//変数宣言
		private $deptId;
		private $deptName;

		//初期化処理
		protected function init()
		{
			$this->deptId = 0;
			$this->deptName = "";
		}

		//値設定
		public function setDeptId($val)
		{
			$this->deptId = $val;
		}

		public function setDeptName($val)
		{
			$this->deptName = $val;
		}

		//入力チェック
		protected function inputCheck()
		{
			//単体チェック
			if($this->deptName == "")
			{
				$this->msg = getMsg($this->dbc,"SYS015");
				return(false);
			}

			return(true);
		}

		//関連チェック
		protected function relationCheck()
		{
			//データ存在チェック
			$dlayChk = new dDeptMst00($this->dbc);
			$dlayChk->setSelectPrm($this->deptId);
			$this->dao = $dlayChk->select();
			if($this->dao == null)
			{
				$this->msg = getMsg($this->dbc,"SYS003");
				return(false);
			}else{
				if($this->dao->getDelFlg() == FlgTrue)
				{
					$this->msg = getMsg($this->dbc,"SYS003");
					return(false);
				}
			}

			return(true);
		}

		//更新データ設定
		protected function setUpdateData()
		{
			$this->dlay = new dDeptMst00($this->dbc);
			$this->dao->setDeptNm($this->deptName);
		}

	}
?>
