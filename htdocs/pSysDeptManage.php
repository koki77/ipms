<?php
	/**
	 * pSysDeptManage
	 *  部署管理
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/14
	 */
	//クラス定義部
	class pSysDeptManage extends fwPBase01
	{
		protected function init()
		{
			$this->flay = new fSysDeptList($_SESSION["userId"],$_SESSION["userName"]);
			$this->flay->setDeptId(DeptAll);
		}

		//開始処理
		protected function startProc()
		{
			if(isset($_POST["return"]))
			{
				goMainMenu();
			}else if(isset($_POST["insert"])){
				$_SESSION["Mode"] = "INSERT";
				goNext("pSysDeptEdit.php");
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
						$_SESSION["SysDeptId"] = $_POST["deptid".$cnt];
						goNext("pSysDeptEdit.php");
					}
					if(isset($_POST["delete".$cnt]))
					{
						$_SESSION["Mode"] = "DELETE";
						$_SESSION["SysDeptId"] = $_POST["deptid".$cnt];
						goNext("pSysDeptEdit.php");
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
<TD width="400px" align="center">部署名</TD>
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
<TD><?php print($this->flay->getDeptName($this->cnt)); ?></TD>
<TD class="BODY"><button type="submit" name="update<?php print($this->cnt); ?>" class="btn2">更新</button></TD>
<TD class="BODY"><button type="submit" name="delete<?php print($this->cnt); ?>" class="btn2">削除</button></TD>
<input type="hidden" name="deptid<?php print($this->cnt); ?>" value="<?php print($this->flay->getDeptId($this->cnt)); ?>">
<?php
		}

		protected function dspButton()
		{
?>
<button type="submit" name="insert" class="btn1">追加</button>
<button type="submit" name="return" class="btn1">戻る</button>
<?php
		}
	}

	//処理実行部
	$play = new pSysDeptManage("部署一覧");
	$play->display();

?>
