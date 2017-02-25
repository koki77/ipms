<?php
	/**
	 * fSysDeptAdd
	 *  部署追加
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/14
	 */
	class fSysDeptAdd extends fwFBase10
	{
		//変数宣言
		protected $insertMsg = "SYS016";
		private $deptName;

		//初期化処理
		protected function init()
		{
			$this->deptName = "";
		}

		//値設定
		public function setDeptName($val)
		{
			$this->deptName = $val;
		}

		//入力チェック
		protected function inputCheck()
		{
			//単体チェック
			if(checkSpaceStr($this->deptName) == false)
			{
				$this->msg = getMsg($this->dbc,"SYS015");
				return(false);
			}

			return(true);
		}

		//追加データ設定
		protected function setInsertData()
		{
			$this->dlay = new dDeptMst00($this->dbc);
			$this->dao = new daoDeptMst();
			$this->dao->setDeptNm($this->deptName);
			$this->dao->setDelFlg(FlgFalse);
		}

	}
?>
