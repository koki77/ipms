<?php
	/**
	 * fwDBase00
	 *  データベースアクセス基底クラス(主キーアクセス)
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/04
	 */
	class fwDBase00
	{
		protected $sqls;
		protected $prms;
		protected $sqli;
		protected $prmi;
		protected $sqlu;
		protected $prmu;
		protected $sqld;
		protected $prmd;
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
				$this->stmt = $this->con->prepare($this->sqls);
				$this->stmt->execute($this->prms);
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
		//データ登録
		public function insert()
		{
			try{
				$this->stmt = $this->con->prepare($this->sqli);
				$flg = $this->stmt->execute($this->prmi);
			}catch (PDOException $e){
    			print('Error:'.$e->getMessage());
    			die();
			}
			if($flg)
			{
				return(true);
			}else{
				return(false);
			}
		}
		//データ更新
		public function update()
		{
			try{
				$this->stmt = $this->con->prepare($this->sqlu);
				$flg = $this->stmt->execute($this->prmu);
			}catch (PDOException $e){
    			print('Error:'.$e->getMessage());
    			die();
			}
			if($flg)
			{
				return(true);
			}else{
				return(false);
			}
		}
		//データ削除
		public function delete()
		{
			try{
				$this->stmt = $this->con->prepare($this->sqld);
				$flg = $this->stmt->execute($this->prmd);
			}catch (PDOException $e){
    			print('Error:'.$e->getMessage());
    			die();
			}
			if($flg)
			{
				return(true);
			}else{
				return(false);
			}
		}
	}
?>