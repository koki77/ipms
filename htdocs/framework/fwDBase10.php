<?php
	/**
	 * fwDBase10
	 *  データベースアクセス基底クラス(単件更新)
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/26
	 */
	class fwDBase10
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

		//データ更新
		public function update()
		{
			try{
				$this->stmt = $this->con->prepare($this->sql);
				$flg = $this->stmt->execute($this->prm);
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
