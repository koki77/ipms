<?php
	/**
	 * fSysDeptDeleteCheck
	 *  部署削除事前チェック
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/15
	 */
	class fSysDeptDeleteCheck extends fwFBase00
	{
		//変数宣言
		private $deptId;
		private $dUser;
		private $delflg;

		//値設定
		public function setDeptId($val)
		{
			$this->deptId = $val;
		}

		//値取得
		public function getDelFlg()
		{
			return($this->delflg);
		}

		//初期化処理
		protected function init()
		{
			$this->deptId = 0;
			$this->delflg = FlgTrue;
		}

		//ユーザ名取得
		protected function getData()
		{
			//DB検索
			$this->dUser = new dUserMst02($this->dbc);
			$this->dUser->setSelectPrm($this->deptId);
			if($this->dUser->select() == 0)
			{
				$this->msg = getMsg($this->dbc,"SYS021");
			}else{
				$this->msg = getMsg($this->dbc,"SYS022");
				$this->delflg = FlgFalse;
			}
		}
	}
?>
