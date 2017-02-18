<?php
	/**
	 * pNetNw1Edit
	 *  大分類ネットワークマスタ編集
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/17
	 */
	//クラス定義部
	class pNetNw1Edit extends fwPBase00
	{
		private $nw1Id;
		private $nwName;
		private $nwText;

		//初期化処理
		protected function init()
		{
			//変数初期化
			$this->nw1Id = "";
			$this->nwName = "";
			$this->nwText = "";

			//部署情報取得
			if($_SESSION["Mode"] == "INSERT")
			{
				$this->flayCall = false;
			}else{
				$this->flay = new fNetNw1Display($_SESSION["userId"]);
			}
		}

		//開始処理
		protected function startProc()
		{
			if(isset($_POST["return"]))
			{
				goNext($_SESSION["SysPrev"]);
			}else if(isset($_POST["update"])){
				if($_SESSION["Mode"] == "INSERT"){
					$flayEdit = new fNetNw1Add($_SESSION["userId"]);
				}else if($_SESSION["Mode"] == "UPDATE"){
					$flayEdit = new fNetNw1Update($_SESSION["userId"]);
				}else{
					$flayEdit = new fNetNw1Delete($_SESSION["userId"]);
				}
				if($_SESSION["Mode"] == "UPDATE" or $_SESSION["Mode"] == "DELETE")
				{
					$flayEdit->setNw1Id($_SESSION["NetNw1Id"]);
				}
				if($_SESSION["Mode"] == "INSERT" or $_SESSION["Mode"] == "UPDATE")
				{
					$this->nwName = $_POST["nwName"];
					$flayEdit->setnwName($_POST["nwName"]);
					$this->nwText = $_POST["nwText"];
					$flayEdit->setnwText($_POST["nwText"]);
				}
				$flayEdit->run();
				if($flayEdit->getResult() == true)
				{
					$_SESSION["SysMsg"] = $flayEdit->getMessage();
					goNext($_SESSION["SysPrev"]);
				}else{
					$this->setMessage($flayEdit->getMessage());
				}
			}

			if($_SESSION["Mode"] == "INSERT"){
				$this->flayCall = false;
				$this->title = "大分類ネットワーク登録";
			}else if($_SESSION["Mode"] == "UPDATE"){
				$this->flay->setNw1Id($_SESSION["NetNw1Id"]);
				$this->title = "大分類ネットワーク変更";
			}else{
				$this->flay->setNw1Id($_SESSION["NetNw1Id"]);
				$this->title = "大分類ネットワーク削除";
			}

		}

		//主表示領域表示
		protected function dspMain()
		{
			if(isset($_POST["return"]) == FALSE and isset($_POST["update"]) == FALSE)
			{
				//初期表示
				if($_SESSION["Mode"] == "UPDATE")
				{
					$this->nwName = $this->flay->getNwName();
					$this->nwText = $this->flay->getNwText();
				}else if($_SESSION["Mode"] == "DELETE")
				{
					$flayCheck = new fNetNw1DeleteCheck($_SESSION["userId"]);
					$this->flay->setNw1Id($_SESSION["NetNw1Id"]);
					$flayCheck->run();
					$this->setMessage($flayCheck->getMessage());
					$this->delFlg = $flayCheck->getDelFlg();
				}
			}
?>
<TABLE>
<?php
				if($_SESSION["Mode"] == "INSERT" or $_SESSION["Mode"] == "UPDATE")
				{
?>
<TR>
<TD align="right">ネットワーク名：</TD>
<TD><input type="text" name="nwName" value="<?php print($this->nwName);?>" maxlength="<?php print(NwLen) ?>"></TD>
</TR>
<TD align="right">説明：</TD>
<TD><input type="text" name="nwText" value="<?php print($this->nwText);?>" maxlength="<?php print(NwTextLen) ?>"></TD>
<?php
				}else{
?>
<TR><TD align="right">ネットワーク名：</TD><TD><?php print($this->flay->getNwName());?></TD></TR>
<TD align="right">説明：</TD><TD><?php print($this->flay->getNwText());?></TD></TR>
<?php
				}
?>
</TABLE>
<?php

				if($_SESSION["Mode"] == "INSERT")
				{
?>
<button type="submit" name="update" class="btn1">追加</button>
<?php
				}else if($_SESSION["Mode"] == "DELETE"){
					if($this->delFlg == FlgTrue)
					{
?>
<button type="submit" name="update" class="btn1">削除</button>
<?php
					}
				}else{
?>
<button type="submit" name="update" class="btn1">更新</button>
<?php
				}
?>
<button type="submit" name="return" class="btn1">戻る</button>
<?php
		}

	}

	//処理実行部
	$play = new pNetNw1Edit("部署管理");
	$play->display();

?>
