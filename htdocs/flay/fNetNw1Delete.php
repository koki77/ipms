<?php
	/**
	 * fNetNw1Delete
	 *  大分類ネットワークマスタ削除
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/18
	 */
	class fNetNw1Delete extends fwFBase11
	{
		//変数宣言
		private $nw1Id;
		protected $updateMsg = "NET006";

		//初期化処理
		protected function init()
		{
			$this->nw1Id = "";
		}

		//値設定
		public function setNw1Id($val)
		{
			$this->nw1Id = $val;
		}

		//関連チェック
		protected function relationCheck()
		{
			//データ存在チェック
			$dlayChk = new dNw1Mst00($this->dbc);
			$dlayChk->setSelectPrm($this->nw1Id);
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
			$this->dlay = new dNw1Mst00($this->dbc);
			$this->dao->setDelFlg(FlgTrue);
		}

	}
?>
