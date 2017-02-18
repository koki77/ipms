<?php
	/**
	 * pSysUserManage
	 *  ユーザー管理
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/04
	 */
	//クラス定義部
	class pSysUserManage extends fwPBase01
	{
		protected function init()
		{
			$this->flay = new fSysUserList($_SESSION["userId"]);
			if(authorityGet(SysAdmin) == FlgTrue)
			{
				$this->flay->setDeptId(DeptAll);
			}else{
				$this->flay->setDeptId($_SESSION["deptId"]);
			}
		}

		//開始処理
		protected function startProc()
		{
			if(isset($_POST["return"]))
			{
				goMainMenu();
			}else if(isset($_POST["insert"])){
				$_SESSION["Mode"] = "INSERT";
				goNext("pSysUserEdit.php");
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
						$_SESSION["SysUserId"] = $_POST["userid".$cnt];
						goNext("pSysUserEdit.php");
					}
					if(isset($_POST["delete".$cnt]))
					{
						$_SESSION["Mode"] = "DELETE";
						$_SESSION["SysUserId"] = $_POST["userid".$cnt];
						goNext("pSysUserEdit.php");
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
<TD width="200px" align="center">ユーザＩＤ</TD>
<TD width="200px" align="center">部署名</TD>
<TD width="200px" align="center">ユーザ名</TD>
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
<TD><?php print($this->flay->getUserId($this->cnt)); ?></TD>
<TD><?php print($this->flay->getDeptName($this->cnt)); ?></TD>
<TD><?php print($this->flay->getUserName($this->cnt)); ?></TD>
<TD class="BODY"><button type="submit" name="update<?php print($this->cnt); ?>" class="btn2">更新</button></TD>
<TD class="BODY"><button type="submit" name="delete<?php print($this->cnt); ?>" class="btn2">削除</button></TD>
<input type="hidden" name="userid<?php print($this->cnt); ?>" value="<?php print($this->flay->getUserId($this->cnt)); ?>">
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
	$play = new pSysUserManage("ユーザ一覧");
	$play->display();

?>
