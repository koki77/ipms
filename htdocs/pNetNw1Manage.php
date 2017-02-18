<?php
	/**
	 * pNetNw1Manage
	 *  大分類ネットワークマスタ管理
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/16
	 */
	//クラス定義部
	class pNetNw1Manage extends fwPBase01
	{
		protected function init()
		{
			$this->flay = new fNetNw1List($_SESSION["userId"]);
		}

		//開始処理
		protected function startProc()
		{
			if(isset($_POST["return"]))
			{
				goMainMenu();
			}else if(isset($_POST["insert"])){
				$_SESSION["Mode"] = "INSERT";
				goNext("pNetNw1Edit.php");
			}else{
				$cnt = 0;
				if(isset($_POST["max"]))
				{
					$max = $_POST["max"];
				}else{
					$max = 0;
				}
				while($max > $cnt)
				{
					if(isset($_POST["nw2edit".$cnt]))
					{
						$_SESSION["NetNw1Id"] = $_POST["nw1Id".$cnt];
						goNext("pNetNw2Manage.php");
					}
					if(isset($_POST["update".$cnt]))
					{
						$_SESSION["Mode"] = "UPDATE";
						$_SESSION["NetNw1Id"] = $_POST["nw1Id".$cnt];
						goNext("pNetNw1Edit.php");
					}
					if(isset($_POST["delete".$cnt]))
					{
						$_SESSION["Mode"] = "DELETE";
						$_SESSION["NetNw1Id"] = $_POST["nw1Id".$cnt];
						goNext("pNetNw1Edit.php");
					}
					$cnt++;
				}
			}
		}

		//主表示領域上段表示
		protected function dspMainTop()
		{
?>
<TABLE class="headfloat">
<thead>
<TR class="header">
<TD width="200px" align="center">大分類ネットワーク名</TD>
<TD width="400px" align="center">説明</TD>
<TD class="BODY"></TD>
<?php
	if(authorityGet(SysAdmin) == FlgTrue)
	{
 ?>
<TD class="BODY"></TD>
<TD class="BODY"></TD>
<?php
	}
 ?>
</TR>
</thead>
<tbody>
<?php
			$this->setMaxLine($this->flay->getCount());
		}

		//主表示領域下段表示
		protected function dspMainBottom()
		{
?>
</tbody>
</TABLE>
<?php
		}

		protected function dspLine()
		{
?>
<TD><?php print($this->flay->getNwName($this->cnt)); ?></TD>
<TD><?php print($this->flay->getNwText($this->cnt)); ?></TD>
<TD class="BODY"><button type="submit" name="nw2edit<?php print($this->cnt); ?>" class="btn2">小分類</button></TD>
<?php
	if(authorityGet(SysAdmin) == FlgTrue)
	{
 ?>
<TD class="BODY"><button type="submit" name="update<?php print($this->cnt); ?>" class="btn2">更新</button></TD>
<TD class="BODY"><button type="submit" name="delete<?php print($this->cnt); ?>" class="btn2">削除</button></TD>
<?php
	}
 ?>
<input type="hidden" name="nw1Id<?php print($this->cnt); ?>" value="<?php print($this->flay->getNw1Id($this->cnt)); ?>">
<?php
		}

		protected function dspButton()
		{
			if(authorityGet(SysAdmin) == FlgTrue)
			{

?>
<button type="submit" name="insert" class="btn1">追加</button>
<button type="submit" name="sortnum" class="btn1">表示順変更</button>
<?php
			}
?>
<button type="submit" name="return" class="btn1">戻る</button>
<?php
		}
	}

	//処理実行部
	$play = new pNetNw1Manage("大分類ネットワーク管理");
	$play->display();

?>
