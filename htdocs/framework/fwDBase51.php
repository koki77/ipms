<?php
	/**
	 * fwDBase51
	 *  データベースアクセス基底クラス(集計処理 検索キー有り)
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/18
	 */
	class fwDBase51
	{
		protected $sql;
		protected $prm;
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
				$this->stmt->execute($this->prm);
			}catch (PDOException $e){
    			print('Error:'.$e->getMessage());
    			die();
			}
			$this->dao = $this->createDao();
			if($this->result = $this->stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->dao->setDao($this->result);
			}
			return($this->dao);
		}

	}
?>
