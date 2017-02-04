<?php
	/**
	 * pSysUserEdit
	 *  ユーザ編集
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/04
	 */
	//クラス定義部
	class pSysUserEdit extends fwPBase00
	{
		private $userId;
		private $userName;
		private $deptId;
		private $deptName;

		//初期化処理
		protected function init()
		{
			//変数初期化
			$this->userId = "";
			$this->userName = "";
			$this->deprId = "";
			$this->deptName = "";

			//ユーザ情報取得
			$this->flay = new fSysUserDisplay($_SESSION["userId"],$_SESSION["userName"]);
		}

		//開始処理
		protected function startProc()
		{
			if(isset($_POST["return"]))
			{
				goNext($_SESSION["SysPrev"]);
			}else if(isset($_POST["update"])){
				if($_SESSION["Mode"] == "UPDATE")
				{
					$flayEdit = new fSysPasswdUpdate($_SESSION["userId"],$_SESSION["userName"]);
				}else{
					$flayEdit = new fSysUserAdd($_SESSION["userId"],$_SESSION["userName"]);
				}
				$this->userId = $_POST["userid"];
				$flayEdit->setUserId($_POST["userid"]);
				$flayEdit->setPassword1($_POST["pass1"]);
				$flayEdit->setPassword2($_POST["pass2"]);
				$flayEdit->run();
				if($flayEdit->getResult() == true)
				{
					$_SESSION["SysMsg"] = $flayEdit->getMessage();
					if($_SESSION["Mode"] == "UPDATE")
					{
						goNext($_SESSION["SysPrev"]);
					}else{
						goNext("pSysUserList.php");
					}
				}else{
					$this->setMessage($flayEdit->getMessage());
				}
			}
			if($_SESSION["Mode"] == "UPDATE")
			{
				$this->flay->setUserId($_SESSION["SysUserId"]);
				$this->title = "パスワード変更";
			}else{
				$this->flayCall = false;
				$this->title = "ユーザ登録";
			}
		}

		//主表示領域表示
		protected function dspMain()
		{
?>
<TABLE>
<?php
			if($_SESSION["Mode"] == "UPDATE")
			{
?>
<TR>
<TD align="right">ユーザＩＤ：</TD>
<TD>
<?php print($_SESSION["SysUserId"]);?>
<input type="hidden" name="userid" value="<?php print($_SESSION["SysUserId"]);?>">
</TD>
</TR>
<TR><TD align="right">ユーザ名：</TD><TD><?php print($this->flay->getUserName());?></TD></TR>
<TR><TD align="right">部署名：</TD><TD><?php print($this->flay->getDeptName());?></TD></TR>
<?php
				}else{
?>
<TR>
<TD align="right">ユーザＩＤ：</TD>
<TD><input type="text" name="userid" value="<?php print($this->userId);?>" maxlength="<?php print(UserIdLen) ?>"></TD>
</TR>
<TR>
<TD align="right">ユーザ名：</TD>
<TD><?php print($_SESSION["SysKName"]);?></TD>
</TR>
<?php
				}
?>
<TR>
<TD align="right">パスワード：</TD><TD><input type="password" name="pass1" maxlength="<?php print(PassLen) ?>"></TD>
</TR>
<TR>
<TD align="right">（確認用）パスワード：</TD><TD><input type="password" name="pass2" maxlength="<?php print(PassLen) ?>"></TD>
</TR>
</TABLE>
<?php
				if($_SESSION["Mode"] == "UPDATE")
				{
?>
			<button type="submit" name="update" class="btn1">更新</button>
<?php
				}else{
?>
			<button type="submit" name="update" class="btn1">追加</button>
<?php
				}
?>
			<button type="submit" name="return" class="btn1">戻る</button>
<?php
		}

	}

	//処理実行部
	$play = new pSysUserEdit("ユーザ管理");
	$play->display();

?>
