<?php
	/**
	 * pSysDeptEdit
	 *  部署編集
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/14
	 */
	//クラス定義部
	class pSysDeptEdit extends fwPBase00
	{
		private $deptId;
		private $deptName;

		//初期化処理
		protected function init()
		{
			//変数初期化
			$this->deptId = "";
			$this->deptName = "";

			//部署情報取得
			$this->flay = new fSysDeptDisplay($_SESSION["userId"],$_SESSION["userName"]);
		}

		//開始処理
		protected function startProc()
		{
			if(isset($_POST["return"]))
			{
				goNext($_SESSION["SysPrev"]);
			}else if(isset($_POST["update"])){
				if($_SESSION["Mode"] == "INSERT"){
					$flayEdit = new fSysDeptAdd($_SESSION["userId"],$_SESSION["userName"]);
				}else if($_SESSION["Mode"] == "UPDATE"){
					$flayEdit = new fSysDeptUpdate($_SESSION["userId"],$_SESSION["userName"]);
				}else{
					$flayEdit = new fSysDeptDelete($_SESSION["userId"],$_SESSION["userName"]);
				}
				if($_SESSION["Mode"] == "UPDATE" or $_SESSION["Mode"] == "DELETE")
				{
					$flayEdit->setDeptId($_SESSION["SysDeptId"]);
				}
				if($_SESSION["Mode"] == "INSERT" or $_SESSION["Mode"] == "UPDATE")
				{
					$this->deptName = $_POST["deptName"];
					$flayEdit->setDeptName($_POST["deptName"]);
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
				$this->title = "部署登録";
			}else if($_SESSION["Mode"] == "UPDATE"){
				$this->flay->setDeptId($_SESSION["SysDeptId"]);
				$this->title = "部署名変更";
			}else{
				$this->flay->setDeptId($_SESSION["SysDeptId"]);
				$this->title = "部署削除";
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
					$this->deptName = $this->flay->getDeptName();
				}else if($_SESSION["Mode"] == "DELETE")
				{
					$flayCheck = new fSysDeptDeleteCheck($_SESSION["userId"],$_SESSION["userName"]);
					$flayCheck->setDeptId($_SESSION["SysDeptId"]);
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
<TD align="right">部署名：</TD>
<TD><input type="text" name="deptName" value="<?php print($this->deptName);?>" maxlength="<?php print(DeptLen) ?>"></TD>
</TR>
<?php
				}else{
?>
<TR><TD align="right">部署名：</TD><TD><?php print($this->flay->getDeptName());?></TD></TR>
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
	$play = new pSysDeptEdit("部署管理");
	$play->display();

?>
