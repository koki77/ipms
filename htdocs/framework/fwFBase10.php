<?php
	/**
	 * fwFBase10
	 *  データ更新機能基底クラス(単体 追加)
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/12
	 */
	class fwFBase10 extends fwFBase00
	{
		protected $dlay;
		protected $dao;
		protected $insertMsg = "SYS002";
		protected $errorMsg = "SYS003";
		protected $result;


		//追加処理
		public function run()
		{
			$this->result = false;
			//単体チェック
			if($this->inputCheck() == true)
			{
				//関連チェック
				if($this->relationCheck() == true)
				{
					$this->setInsertData();
					$this->dlay->setInsertPrm($this->dao);
					if($this->dlay->insert() == true)
					{
						$this->msg = getMsg($this->dbc,$this->insertMsg);
						$this->result = true;
						$this->dbc->Commit();
					}else{
						$this->msg = getMsg($this->dbc,$this->errorinsertMsg);
						$this->dbc->RollBack();
					}
				}
			}
		}

		//単体チェック
		protected function inputCheck()
		{
			return(true);
		}

		//関連チェック
		protected function relationCheck()
		{
			return(true);
		}

		//追加データ設定
		protected function setInsertData()
		{
		}

		//処理結果取得(true=成功/false=失敗)
		public function getResult()
		{
			return($this->result);
		}
	}
?>
