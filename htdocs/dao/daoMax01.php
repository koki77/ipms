<?php
	/**
	 * daoMax01
	 *  最大値取得用Data Access Object
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2017/02/18
	 */
	class daoMax01
	{
		private $max;//合計

		//初期処理
		public function __construct()
		{
			$this->initVal();
		}

		//値取得
		public function getMax()
		{
			return($this->max);
		}

		//初期化
		public function initVal()
		{
			$this->max = 0;
		}

		//Dao編集
		function setDao($result)
		{
			$this->max = $result["maxval"];
		}
	}


?>
