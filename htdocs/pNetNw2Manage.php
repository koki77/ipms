<?php
	/**
	 * pNetNw2Manage
	 *  小分類ネットワークマスタ管理
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/18
	 */
	//クラス定義部
	class pNetNw2Manage extends fwPBase01
	{
		protected function init()
		{
			$this->flay = new fNetNw2List1($_SESSION["userId"]);
		}

		//開始処理
		protected function startProc()
		{
			if(isset($_POST["return"]))
			{
				goNext("pNetNw1Manage.php");
			}else if(isset($_POST["insert"])){
				$_SESSION["Mode"] = "INSERT";
				goNext("pNetNw2Edit.php");
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
					if(isset($_POST["update".$cnt]))
					{
						$_SESSION["Mode"] = "UPDATE";
						$_SESSION["NetNwId"] = $_POST["nwId".$cnt];
						goNext("pNetNw2Edit.php");
					}
					if(isset($_POST["delete".$cnt]))
					{
						$_SESSION["Mode"] = "DELETE";
						$_SESSION["NetNwId"] = $_POST["nwId".$cnt];
						goNext("pNetNw2Edit.php");
					}
					$cnt++;
				}
			}
			$this->flay->setNw1Id($_SESSION["NetNw1Id"]);
		}

		//主表示領域上段表示
		protected function dspMainTop()
		{
?>
<TABLE class="headfloat">
<thead>
<TR>
<TD class="BODY" colspan="5" align="left">大分類ネットワーク名：<?php print($this->flay->getNw1Name());?></TD>
</TR>
<TR class="header">
<TD width="200px" align="center">小分類ネットワーク名</TD>
<TD width="200px" align="center">アドレス</TD>
<TD width="300px" align="center">説明</TD>
<TD class="BODY"></TD>
<TD class="BODY"></TD>
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
<TD><?php print($this->flay->getDisplayAddr($this->cnt)); ?></TD>
<TD><?php print($this->flay->getNwText($this->cnt)); ?></TD>
<?php
			if($this->flay->getAuthFlg($this->cnt) == FlgTrue)
			{
 ?>
<TD class="BODY"><button type="submit" name="update<?php print($this->cnt); ?>" class="btn2">更新</button></TD>
<TD class="BODY"><button type="submit" name="delete<?php print($this->cnt); ?>" class="btn2">削除</button></TD>
<?php
			}else{
 ?>
 <TD></TD>
 <TD></TD>
 <?php
 			}
  ?>
<input type="hidden" name="nwId<?php print($this->cnt); ?>" value="<?php print($this->flay->getNwId($this->cnt)); ?>">
<?php
		}

		protected function dspButton()
		{
?>
<button type="submit" name="insert" class="btn1">追加</button>
<button type="submit" name="sortnum" class="btn1">表示順変更</button>
<button type="submit" name="return" class="btn1">戻る</button>
<?php
		}
	}

	//処理実行部
	$play = new pNetNw2Manage("小分類ネットワーク管理");
	$play->display();

?>
