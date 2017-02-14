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
		private $sysadmin;
		private $deptAdmin;
		private $nwAdmin;
		private $delFlg;

		//初期化処理
		protected function init()
		{
			//変数初期化
			$this->userId = "";
			$this->userName = "";
			$this->deptId = "";
			$this->deptName = "";
			$this->sysadmin = FlgFalse;
			$this->deptAdmin = FlgFalse;
			$this->nwAdmin = FlgFalse;
			$this->delFlg = FlgFalse;

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
				}else if($_SESSION["Mode"] == "INSERT"){
					$flayEdit = new fSysUserAdd($_SESSION["userId"],$_SESSION["userName"]);
				}else if($_SESSION["Mode"] == "UPDATE"){
					$flayEdit = new fSysUserUpdate($_SESSION["userId"],$_SESSION["userName"]);
				}else if($_SESSION["Mode"] == "DELETE"){
					$flayEdit = new fSysUserDelete($_SESSION["userId"],$_SESSION["userName"]);
				}else{
					$flayEdit = new fSysUserDeptChange($_SESSION["userId"],$_SESSION["userName"]);
				}
				$this->userId = $_POST["userid"];
				$flayEdit->setUserId($_POST["userid"]);
				if($_SESSION["Mode"] == "PASSWORD" or $_SESSION["Mode"] == "INSERT" or $_SESSION["Mode"] == "UPDATE")
				{
					$flayEdit->setPassword1($_POST["pass1"]);
					$flayEdit->setPassword2($_POST["pass2"]);
				}
				if($_SESSION["Mode"] == "INSERT" or $_SESSION["Mode"] == "UPDATE")
				{
					$this->userName = $_POST["usernm"];
					$flayEdit->setUserName($_POST["usernm"]);
				}

				if($_SESSION["Mode"] == "INSERT" or $_SESSION["Mode"] == "DEPTCHNG")
				{
					if(authorityGet(SysAdmin) == FlgTrue)
					{
						$this->deptid = $_POST["deptId"];
						$flayEdit->setDeptId($_POST["deptId"]);
					}else{
						$flayEdit->setDeptId($_SESSION["deptId"]);
					}
				}
				if($_SESSION["Mode"] == "INSERT" or $_SESSION["Mode"] == "UPDATE" or $_SESSION["Mode"] == "DEPTCHNG")
				{
					$this->sysadmin = FlgFalse;
					$this->deptAdmin = FlgFalse;
					$this->nwAdmin = FlgFalse;
					if(isset($_POST["auth"]))
					{
						while(list($key,$val) = each($_POST["auth"]))
						{
							switch($val)
							{
								case "sysadmin":
									$this->sysadmin = FlgTrue;
									break;
								case "deptAdmin":
									$this->deptAdmin = FlgTrue;
									break;
								case "nwAdmin":
									$this->nwAdmin = FlgTrue;
									break;
							}
						}
					}
					if(authorityGet(SysAdmin) == FlgFalse)
					{
						$this->sysadmin = $_POST["sysadmin"];
					}
					$flayEdit->setSysadmin($this->sysadmin);
					$flayEdit->setAuth(DeptAdminIdx,$this->deptAdmin);
					$flayEdit->setAuth(NwAdminIdx,$this->nwAdmin);
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
			if(isset($_POST["return"]) == FALSE and isset($_POST["update"]) == FALSE)
			{
				//初期表示
				if($_SESSION["Mode"] == "UPDATE")
				{
					$this->userName = $this->flay->getUserName();
					$this->sysadmin = $this->flay->getSysadmin();
					$this->deptAdmin = $this->flay->getAuth(DeptAdminIdx);
					$this->nwAdmin = $this->flay->getAuth(NwAdminIdx);
				}else	if($_SESSION["Mode"] == "DEPTCHNG")
				{
					$this->deptId = $this->flay->getDeptId();
					$this->sysadmin = $this->flay->getSysadmin();
					$this->deptAdmin = FlgFalse;
					$this->nwAdmin = FlgFalse;
				}else if($_SESSION["Mode"] == "DELETE")
				{
					$flayCheck = new fSysUserDeleteCheck($_SESSION["userId"],$_SESSION["userName"]);
					$flayCheck->setUserId($_SESSION["SysUserId"]);
					$flayCheck->run();
					$this->setMessage($flayCheck->getMessage());
					$this->delFlg = $flayCheck->getDelFlg();
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

				if($_SESSION["Mode"] == "INSERT" or $_SESSION["Mode"] == "UPDATE" or $_SESSION["Mode"] == "DEPTCHNG")
				{
					if(authorityGet(SysAdmin) == FlgTrue)
					{
						if($this->sysadmin == FlgTrue)
						{
							$chk = "checked=\"checked\"";
						}else{
							$chk = "";
						}
?>
<TR>
<TD align="right">システム管理者：</TD>
<TD>
<input type="checkbox" name="auth[]" value="sysadmin" <?php print($chk); ?> />
</TD>
</TR>
<?php
					}else{
?>
<input type="hidden" name="sysadmin" value="<?php print($this->sysadmin);?>">
<?php
					}

					if($this->deptAdmin == FlgTrue)
					{
						$chk = "checked=\"checked\"";
					}else{
						$chk = "";
					}
?>
<TR>
<TD align="right">部門管理者：</TD>
<TD>
<lable><input type="checkbox" name="auth[]" value="deptAdmin"  <?php print($chk); ?> />
</TD>
</TR>
<?php

					if($this->nwAdmin == FlgTrue)
					{
						$chk = "checked=\"checked\"";
					}else{
						$chk = "";
					}
?>
<TR>
<TD align="right">ネットワーク管理者：</TD>
<TD>
<lable><input type="checkbox" name="auth[]" value="nwAdmin"  <?php print($chk); ?> />
</TD>
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
	$play = new pSysUserEdit("ユーザ管理");
	$play->display();

?>
