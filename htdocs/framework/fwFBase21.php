<?php
	/**
	 * fwFBase21
	 *  データ更新機能基底クラス(同一dao 複数件追加)
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/03/04
	 */
	class fwFBase21 extends fwFBase00
	{
		protected $dlay;
		protected $dao;
		protected $insertCnt;
		protected $cnt;
		protected $insertFlg;
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
					$this->setInsertCount();
					$this->cnt = 0;
					$resultFlg = FlgTrue;
					while($this->insertCnt > $this->cnt)
					{
						$this->setInsertData();
						if($this->insertFlg == FlgTrue)
						{
							$this->dlay->setInsertPrm($this->dao);
							if($this->dlay->insert() == false)
							{
								$resultFlg = FlgFalse;
								$this->cnt = $this->insertCnt;
							}
						}
						$this->cnt++;
					}
					if($resultFlg == FlgTrue)
					{
						$this->msg = getMsg($this->dbc,$this->insertMsg);
						$this->result = true;
						$this->dbc->Commit();
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

		//インサート件数設定
		protected function setInsertCount()
		{
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
