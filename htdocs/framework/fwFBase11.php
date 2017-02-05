<?php
	/**
	 * fwFBase11
	 *  データ更新機能基底クラス(単体 更新)
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/04
	 */
	class fwFBase11 extends fwFBase00
	{
		protected $updateMsg = "SYS002";
		protected $errorMsg = "SYS003";
		protected $result;


		//更新処理
		public function run()
		{
			$this->result = false;
			//単体チェック
			if($this->inputCheck() == true)
			{
				//関連チェック
				if($this->relationCheck() == true)
				{
					$this->setUpdateData();
					if($this->updateProc() == true)
					{
						$this->msg = getMsg($this->dbc,$this->updateMsg);
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

		//更新データ設定
		protected function setUpdateData()
		{
		}

		//更新処理
		protected function updateProc()
		{
			return(true);
		}

		//処理結果取得(true=成功/false=失敗)
		public function getResult()
		{
			return($this->result);
		}
	}
?>
