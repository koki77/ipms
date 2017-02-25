<?php
	/**
	 * fNetNw2Delete
	 *  小分類ネットワークマスタ削除
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/23
	 */
	class fNetNw2Delete extends fwFBase11
	{
		//変数宣言
		private $nwId;
		protected $updateMsg = "NET008";

		//初期化処理
		protected function init()
		{
			$this->nwId = 0;
		}

		//値設定
		public function setNwId($val)
		{
			$this->nwId = $val;
		}

		//関連チェック
		protected function relationCheck()
		{
			//データ存在チェック
			$dlayChk = new dNw2Mst00($this->dbc);
			$dlayChk->setSelectPrm($this->nwId);
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

		//削除データ設定
		protected function setUpdateData()
		{
			$this->dlay = new dNw2Mst00($this->dbc);
			$this->dao->setDelFlg(FlgTrue);
		}

	}
?>
