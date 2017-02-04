<?php
	/**
	 * dDbCtl
	 *  DB接続管理
	 *
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/04
	 */
	class dDbCtl
	{

		private $dsn = DbDns;
		private $user = DbUser;
		private $pass = DbPass;
		private $con;
		private $msg;

		//DB接続
		public function __construct()
		{
			try{
    			$this->con = new PDO($this->dsn, $this->user, $this->pass);
				$this->con->beginTransaction();
			}catch (PDOException $e){
    			print('Error:'.$e->getMessage());
    			die();
			}
		}

		//接続情報の取得
		public function getConnect()
		{
			return($this->con);
		}

		//DB切断
		public function disConnect()
		{
			$this->con->commit();
			$this->con = null;
		}

		//DBコミット
		public function Commit()
		{
			$this->con->commit();
		}

		//DBロールバック
		public function rollBack()
		{
			$this->con->rollBack();
			$this->con = null;
		}

	}

?>
