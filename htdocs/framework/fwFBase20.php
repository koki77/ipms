<?php
	/**
	 * fwFBase20
	 *  データ更新機能基底クラス(２件 追加)
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/18
	 */
	class fwFBase20 extends fwFBase00
	{
		protected $dlay1;
		protected $dao1;
		protected $dlay2;
		protected $dao2;
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
					$this->dlay1->setInsertPrm($this->dao1);
					if($this->dlay1->insert() == true)
					{
						$this->dlay2->setInsertPrm($this->dao2);
						if($this->dlay2->insert() == true)
						{
							$this->msg = getMsg($this->dbc,$this->insertMsg);
							$this->result = true;
							$this->dbc->Commit();
						}else{
							$this->msg = getMsg($this->dbc,$this->errorMsg);
							$this->dbc->RollBack();
						}
					}else{
						$this->msg = getMsg($this->dbc,$this->errorMsg);
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
