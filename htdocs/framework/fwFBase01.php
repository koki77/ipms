<?php
	/**
	 * fwFBase01
	 *  画面表示機能基底クラス(一覧表示)
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/04
	 */
	class fwFBase01 extends fwFBase00
	{
		protected $cnt;
		protected $dlay;
		protected $dao;
		protected $max;

		//DB検索
		public function run()
		{
			$this->getData();
			$this->setDlay();
			$max = $this->dlay->select();
			$this->cnt = 0;
			while($max > $this->cnt)
			{
				$this->getLine();
				$this->cnt++;
			}
			$this->dbc->Commit();
		}

		//明細検索用Dlay設定
		protected function setDlay()
		{
		}

		//1件取得
		protected function getLine()
		{
			$this->dao = $this->dlay->fetch();
			if($this->dao == null)
			{
				abend();
			}else{
				$this->initLine();
				$this->getLineData();
			}
		}

		//明細データ取得
		protected function getLineData()
		{
		}

		//明細行初期化
		protected function initLine()
		{
		}

	}
?>
