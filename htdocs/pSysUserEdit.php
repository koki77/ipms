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
			$this->deptId = "";
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
				if($_SESSION["Mode"] == "PASSWORD")
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
					goNext($_SESSION["SysPrev"]);
				}else{
					$this->setMessage($flayEdit->getMessage());
				}
			}

			if($_SESSION["Mode"] == "PASSWORD")
			{
				$this->flay->setUserId($_SESSION["SysUserId"]);
				$this->title = "パスワード変更";
			}else if($_SESSION["Mode"] == "INSERT"){
				$this->flayCall = false;
				$this->title = "ユーザ登録";
			}else if($_SESSION["Mode"] == "UPDATE"){
				$this->flay->setUserId($_SESSION["SysUserId"]);
				$this->title = "ユーザ情報変更";
			}else if($_SESSION["Mode"] == "DELETE"){
				$this->flay->setUserId($_SESSION["SysUserId"]);
				$this->title = "ユーザ削除";
			}else{
				//部署変更
				$this->flay->setUserId($_SESSION["SysUserId"]);
				$this->title = "部署変更";
			}

		}

		//主表示領域表示
		protected function dspMain()
		{
			if(isset($_POST["return"],$_POST["update"]) == FALSE)
			{
				//初期表示
				if($_SESSION["Mode"] == "UPDATE"){
					$this->userName = $this->flay->getUserName();
				}else	if($_SESSION["Mode"] == "DEPTCHNG"){
					$this->deptId = $this->flay->getDeptId();
				}
			}
?>
<TABLE>
<?php
				if($_SESSION["Mode"] == "INSERT")
				{
?>
<TR>
<TD align="right">ユーザＩＤ：</TD>
<TD><input type="text" name="userid" value="<?php print($this->userId);?>" maxlength="<?php print(UserIdLen) ?>"></TD>
</TR>
<?php
				}else{
?>
<TR>
<TD align="right">ユーザＩＤ：</TD>
<TD>
<?php print($_SESSION["SysUserId"]);?>
<input type="hidden" name="userid" value="<?php print($_SESSION["SysUserId"]);?>">
</TD>
</TR>
<?php
				}

				if($_SESSION["Mode"] == "INSERT" or $_SESSION["Mode"] == "UPDATE")
				{
?>
<TR>
<TD align="right">ユーザ名：</TD>
<TD><input type="text" name="usernm" value="<?php print($this->userName);?>" maxlength="<?php print(NameLen) ?>"></TD>
</TR>
<?php
				}else{
?>
<TR><TD align="right">ユーザ名：</TD><TD><?php print($this->flay->getUserName());?></TD></TR>
<?php
				}
				if($_SESSION["Mode"] == "INSERT" or $_SESSION["Mode"] == "DEPTCHNG")
				{
?>
<TR>
<TD align="right">部署名：</TD>
<TD>
<?php
					$flayDept = new fSysDeptList($_SESSION["userId"],$_SESSION["userName"]);
					if(authorityGet(SysAdmin) == FlgTrue)
					{
						$flayDept->setDeptId(DeptAll);
						$flayDept->run();
						$cnt = 0;
?>
<select name="deptId">
<?php
					while ($flayDept->getCount() > $cnt) {
							if($flayDept->getDeptId($cnt) == $this->deptId)
							{
								$sel = "selected";
							}else{
								$sel = "";
							}
?>
<option value="<?php print($flayDept->getDeptId($cnt));?>" <?php print($sel);?>><?php print($flayDept->getDeptName($cnt));?></option>
<?php
							$cnt++;
						}
?>
</select>
<?php
					}else{
						$flayDept->setDeptId($_SESSION["deptId"]);
						$flayDept->run();
						print($flayDept->getDeptName(0));
					}
?>
</TD>
</TR>
<?php
				}else{
?>
<TR><TD align="right">部署名：</TD><TD><?php print($this->flay->getDeptName());?></TD></TR>
<?php
				}

				if($_SESSION["Mode"] == "INSERT" or $_SESSION["Mode"] == "UPDATE" or $_SESSION["Mode"] == "PASSWORD")
				{
?>
<TR>
<TD align="right">パスワード：</TD><TD><input type="password" name="pass1" maxlength="<?php print(PassLen) ?>"></TD>
</TR>
<TR>
<TD align="right">（確認用）パスワード：</TD><TD><input type="password" name="pass2" maxlength="<?php print(PassLen) ?>"></TD>
</TR>
<?php
				}

				if($_SESSION["Mode"] == "INSERT" or $_SESSION["Mode"] == "UPDATE")
				{
					if(authorityGet(SysAdmin) == FlgTrue){
?>
<TR>
<TD align="right">システム管理者：</TD><TD align="left"><input type="checkbox" name="sysAdmin"></TD>
</TR>
<?php
					}
?>
<TR>
<TD align="right">部署管理者：</TD><TD align="left"><input type="checkbox" name="deptAdmin"></TD>
</TR>
<TR>
<TD align="right">ネットワーク管理者：</TD><TD align="left"><input type="checkbox" name="nwAdmin"></TD>
</TR>

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
?>
<button type="submit" name="update" class="btn1">削除</button>
<?php
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
	$play = new pSysUserEdit("ユーザ管理");
	$play->display();

?>
