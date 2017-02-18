<?php
	/**
	 * fNetNw1DeleteCheck
	 *  大分類ネットワークマスタ削除事前チェック
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/18
	 */
	class fNetNw1DeleteCheck extends fwFBase00
	{
		//変数宣言
		private $nw1Id;
		private $dNw1;
		private $delflg;

		//値設定
		public function setNw1Id($val)
		{
			$this->nw1Id = $val;
		}

		//値取得
		public function getDelFlg()
		{
			return($this->delflg);
		}

		//初期化処理
		protected function init()
		{
			$this->nw1Id = 0;
			$this->delflg = FlgTrue;
		}

		//ユーザ名取得
		protected function getData()
		{
			//DB検索
			$this->dNw1 = new dNw2Mst01($this->dbc);
			$this->dNw1->setSelectPrm($this->nw1Id);
			if($this->dNw1->select() == 0)
			{
				$this->msg = getMsg($this->dbc,"NET004");
			}else{
				$this->msg = getMsg($this->dbc,"NET005");
				$this->delflg = FlgFalse;
			}
		}
	}
?>
