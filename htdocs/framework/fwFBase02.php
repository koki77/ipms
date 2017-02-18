<?php
	/**
	 * fwFBase02
	 *  画面表示機能基底クラス(一覧表示:表示条件チェック付)
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/17
	 */
	class fwFBase02 extends fwFBase01
	{
		//1件取得
		protected function getLine()
		{
			$this->dao = $this->dlay->fetch();
			if($this->dao == null)
			{
				abend();
			}else{
				if($this->checkLineData() == true)
				{
					$this->initLine();
					$this->getLineData();
				}
			}
		}

		//明細データ取り込みチェック
		protected function checkLineData()
		{
		}

	}
?>
