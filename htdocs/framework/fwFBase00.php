<?php
	/**
	 * fwFBase00
	 *  画面表示機能基底クラス(単件表示)
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/04
	 */
	class fwFBase00
	{
		protected $dbc;
		protected $uId;
		protected $msg;

		public function __construct($userid)
		{
			$this->uId = $userid;
			$this->msg = "";
			$this->dbc = new dDbCtl();
			$this->init();
		}

		//初期化処理
		protected function init()
		{
		}

		//主処理実行
		public function run()
		{
			$this->getData();
			$this->dbc->Commit();
		}

		//画面表示データ取得
		protected function getData()
		{
		}

		//画面表示用メッセージ取得
		public function getMessage()
		{
			return($this->msg);
		}

	}
?>
