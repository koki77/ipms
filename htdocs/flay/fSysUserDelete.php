<?php
	/**
	 * fSysUserDelete
	 *  ユーザー削除
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/12
	 */
	class fSysUserDelete extends fwFBase11
	{
		//変数宣言
		private $userId;

		//初期化処理
		protected function init()
		{
			$this->userId = "";
		}

		//値設定
		public function setUserId($val)
		{
			$this->userId = $val;
		}

		//関連チェック
		protected function relationCheck()
		{
			//データ存在チェック
			$dlayChk = new dUserMst00($this->dbc);
			$dlayChk->setSelectPrm($this->userId);
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

		//追加データ設定
		protected function setUpdateData()
		{
			$this->dlay = new dUserMst00($this->dbc);
			$this->dao->setDelFlg(FlgTrue);
		}

	}
?>
