<?php
	/**
	 * fwDBase50
	 *  データベースアクセス基底クラス(集計処理 検索キー無し)
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/18
	 */
	class fwDBase50
	{
		protected $sql;
		protected $dao;
		private $con;
		private $stmt;
		private $result;

		//Dao生成
		protected function createDao()
		{
		}

		//初期化
		public function __construct($dbc)
		{
			$this->con = $dbc->getconnect();
		}

		//検索実行
		public function select()
		{
			try{
				$this->stmt = $this->con->prepare($this->sql);
				$this->stmt->execute();
			}catch (PDOException $e){
    			print('Error:'.$e->getMessage());
    			die();
			}
			if($this->result = $this->stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->dao = $this->createDao();
				$this->dao->setDao($this->result);
			}
			return($this->dao);
		}

	}
?>
