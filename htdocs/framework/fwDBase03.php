<?php
	/**
	 * fwDBase03
	 *  データベースアクセス基底クラス(キー指定単件検索)
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/26
	 */
	class fwDBase03
	{
		protected $sql;
		protected $prm;
		private $dao;
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
			if($this->result = $this->stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->dao = $this->createDao();
				$this->dao->setDao($this->result);
			}else{
				$this->dao = null;
			}
			return($this->dao);
		}

	}

?>
