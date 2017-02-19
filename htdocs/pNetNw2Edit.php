<?php
	/**
	 * pNetNw2Edit
	 *  小分類ネットワークマスタ編集
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/19
	 */
	//クラス定義部
	class pNetNw2Edit extends fwPBase00
	{
		private $nwName;
		private $nwText;
		private $addr;
		private $mask;
		private $dupFlg;

		//初期化処理
		protected function init()
		{
			//変数初期化
			$this->nwName = "";
			$this->nwText = "";
			$this->addr = "";
			$this->mask = 24;
			$this->dupFlg = DupKbNG;

			//部署情報取得
			if($_SESSION["Mode"] == "INSERT")
			{
				$this->flayCall = false;
			}else{
				$this->flay = new fNetNw2Display($_SESSION["userId"]);
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
					$flayEdit = new fNetNw2Add($_SESSION["userId"]);
				}else if($_SESSION["Mode"] == "UPDATE"){
					$flayEdit = new fNetNw2Update($_SESSION["userId"]);
				}else{
					$flayEdit = new fNetNw2Delete($_SESSION["userId"]);
				}
				if($_SESSION["Mode"] == "UPDATE" or $_SESSION["Mode"] == "DELETE")
				{
					$flayEdit->setNwId($_SESSION["NetNwId"]);
				}
				if($_SESSION["Mode"] == "INSERT" or $_SESSION["Mode"] == "UPDATE")
				{
					$flayEdit->setNw1Id($_SESSION["NetNw1Id"]);
					$this->nwName = $_POST["nwName"];
					$flayEdit->setNwName($_POST["nwName"]);
					$this->nwText = $_POST["nwText"];
					$flayEdit->setNwText($_POST["nwText"]);
					$this->addr = $_POST["addr"];
					$flayEdit->setAddr($_POST["addr"]);
					$this->mask = $_POST["mask"];
					$flayEdit->setMask($_POST["mask"]);
					$this->dupFlg = $_POST["dupFlg"];
					$flayEdit->setDupFlg($_POST["dupFlg"]);
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
				$this->title = "小分類ネットワーク登録";
			}else if($_SESSION["Mode"] == "UPDATE"){
				$this->flay->setNwId($_SESSION["NetNwId"]);
				$this->title = "小分類ネットワーク変更";
			}else{
				$this->flay->setNwId($_SESSION["NetNwId"]);
				$this->title = "小分類ネットワーク削除";
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
					$this->addr = $this->flay->getDisplayAddr();
					$this->mask = $this->flay->getMask();
					$this->dupFlg = $this->flay->getDupFlg();
			}else if($_SESSION["Mode"] == "DELETE")
				{
					$flayCheck = new fNetNw2DeleteCheck($_SESSION["userId"]);
					$this->flay->setNwId($_SESSION["NetNwId"]);
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
<TR>
<TD align="right">説明：</TD>
<TD><input type="text" name="nwText" value="<?php print($this->nwText);?>" maxlength="<?php print(NwTextLen) ?>"></TD>
</TR>
<TR>
<TD align="right">ネットワークアドレス：</TD>
<TD><input type="text" name="addr" value="<?php print($this->addr);?>" maxlength="15"></TD>
</TR>
<TR>
<?php
						$flayCode = new fSysCodeList($_SESSION["userId"]);
						$flayCode->setCodeKb(2);
						$flayCode->run();
						$cnt = 0;
?>
<TR>
<TD align="right">ネットマスク：</TD>
<TD>
<select name="mask">
<?php
					while ($flayCode->getCount() > $cnt) {
							if($flayCode->getCodeId($cnt) == $this->mask)
							{
								$sel = "selected";
							}else{
								$sel = "";
							}
?>
<option value="<?php print($flayCode->getCodeId($cnt));?>" <?php print($sel);?>><?php print($flayCode->getCodeId($cnt).":".$flayCode->getCodeName($cnt));?></option>
<?php
							$cnt++;
						}
?>
</select>
</TD>
</TR>
<?php
					$flayCode = new fSysCodeList($_SESSION["userId"]);
					$flayCode->setCodeKb(1);
					$flayCode->run();
					$cnt = 0;
?>
<TR>
<TD align="right">アドレス重複区分：</TD>
<TD>
<select name="dupFlg">
<?php
					while ($flayCode->getCount() > $cnt) {
							if($flayCode->getCodeId($cnt) == $this->dupFlg)
							{
								$sel = "selected";
							}else{
								$sel = "";
							}
?>
<option value="<?php print($flayCode->getCodeId($cnt));?>" <?php print($sel);?>><?php print($flayCode->getCodeName($cnt));?></option>
<?php
							$cnt++;
						}
?>
</select>
</TD>
<?php
				}else{
?>
<TR><TD align="right">ネットワーク名：</TD><TD><?php print($this->flay->getNwName());?></TD></TR>
<TR><TD align="right">説明：</TD><TD><?php print($this->flay->getNwText());?></TD></TR>
<TR><TD align="right">アドレス：</TD><TD><?php print($this->flay->getDisplayAddr());?></TD></TR>
<TR><TD align="right">ネットマスク：</TD><TD><?php print($this->flay->getDisplayMask());?></TD></TR>
<TR><TD align="right">アドレス重複：</TD><TD><?php print($this->flay->getDisplayDupFlg());?></TD></TR>
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
	$play = new pNetNw2Edit("小分類ネットワーク管理");
	$play->display();

?>
