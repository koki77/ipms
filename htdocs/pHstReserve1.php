<?php
	/**
	 * pHstReserve1
	 *  ホスト名予約（手入力）
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/03/02
	 */
	//クラス定義部
	class pHstReserve1 extends fwPBase00
	{
		private $hostName;
		private $hostText;
		private $hostType;
		private $maxLine;

		//初期化処理
		protected function init()
		{
			//変数初期化
			$this->hostName = array();
			$this->hostText = array();
			$this->hostType = array();

			//入力行数設定
			$this->maxLine = 10;

			//入力値初期化
			$cnt = 0;
			while($this->maxLine > $cnt)
			{
				$this->hostName[$cnt] = "";
				$this->hostText[$cnt] = "";
				$this->hostType[$cnt] = 0;
				$cnt++;
			}

			//ホスト種別取得
			$this->flay = new fSysCodeList($_SESSION["userId"]);
			$this->flay->setCodeKb(3);
		}

		//開始処理
		protected function startProc()
		{
			if(isset($_POST["return"]))
			{
				goNext($_SESSION["SysPrev"]);
			}else if(isset($_POST["update"])){
				$flayEdit = new fHstReserve($_SESSION["userId"]);
				$cnt = 0;
				while($this->maxLine > $cnt)
				{
					$this->hostName[$cnt] = $_POST["hostName".$cnt];
					$this->hostText[$cnt] = $_POST["hostText".$cnt];
					$this->hostType[$cnt] = $_POST["hostType".$cnt];
					$cnt++;
				}
				$flayEdit->setHostName($this->hostName);
				$flayEdit->setHostText($this->hostText);
				$flayEdit->setHostType($this->hostType);
				$flayEdit->run();
				if($flayEdit->getResult() == true)
				{
					$_SESSION["SysMsg"] = $flayEdit->getMessage();
					goNext($_SESSION["SysPrev"]);
				}else{
					$this->setMessage($flayEdit->getMessage());
				}
			}

		}

		//主表示領域表示
		protected function dspMain()
		{
?>
<TABLE>
<TR class="header">
<TD width="100px" align="center">ホスト名</TD>
<TD width="400px" align="center">説明</TD>
<TD width="100px" align="center">ホスト種別</TD>
</TR>
<?php
			$cnt1 = 0;
			while($this->maxLine > $cnt1)
			{
?>
<TR>
<TD><input type="text" name="hostName<?php print($cnt1);?>" value="<?php print($this->hostName[$cnt1]);?>" maxlength="<?php print(HostLen) ?>"></TD>
<TD><input type="text" name="hostText<?php print($cnt1);?>" value="<?php print($this->hostText[$cnt1]);?>" maxlength="<?php print(HostTextLen) ?>"></TD>
<TD>
<select name="hostType<?php print($cnt1);?>">
<?php
				$cnt2 = 0;
				while ($this->flay->getCount() > $cnt2)
				{
						if($this->flay->getCodeId($cnt2) == $this->hostType[$cnt1])
						{
							$sel = "selected";
						}else{
							$sel = "";
						}
?>
<option value="<?php print($this->flay->getCodeId($cnt2));?>" <?php print($sel);?>><?php print($this->flay->getCodeName($cnt2));?></option>
<?php
						$cnt2++;
				}
?>
</select>
</TD>
</TR>
<?php
				$cnt1++;
			}
?>
</TABLE>
<button type="submit" name="update" class="btn1">登録</button>
<button type="submit" name="return" class="btn1">戻る</button>
<?php
		}

	}

	//処理実行部
	$play = new pHstReserve1("ホスト名予約");
	$play->display();

?>
