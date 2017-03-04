<?php
	/**
	 * pSysMenuMain
	 *  メインメニュー
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/04
	 */
	//クラス定義部
	class pSysMenuMain extends fwPBase00
	{
		//初期化処理
		protected function init()
		{
			//仮置き
			$this->flayCall = false;
			//$this->flay = new fwFBase00("dummy");
		}

		//開始処理
		protected function startProc()
		{
			if(isset($_POST["SYS010"]))
			{
				goNext("pHstReserve1.php");
			}else if(isset($_POST["SYS110"])){
				goNext("pNetNw1Manage.php");
			}else if(isset($_POST["SYS900"])){
				goNext("pSysUserManage.php");
			}else if(isset($_POST["SYS910"])){
				goNext("pSysDeptChange.php");
			}else if(isset($_POST["SYS920"])){
				goNext("pSysDeptManage.php");
			}else if(isset($_POST["SYS980"])){
				$_SESSION["SysUserId"] = $_SESSION["userId"];
				$_SESSION["Mode"] = "PASSWORD";
				goNext("pSysUserEdit.php");
			}
		}

		//主表示領域表示
		protected function dspMain()
		{
?>
<button type="submit" name="SYS010" class="btn0" tabindex=010>ホスト名予約</button><br>
<button type="submit" name="SYS100" class="btn0" tabindex=100>ネットワーク参照</button><br>
<?php
	if(authorityGet(NwAdmin) == FlgTrue || authorityGet(SysAdmin) == FlgTrue)
	{
 ?>
<button type="submit" name="SYS110" class="btn0" tabindex=110>ネットワーク管理</button><br>
<?php
	}

	if(authorityGet(DeptAdmin) == FlgTrue || authorityGet(SysAdmin) == FlgTrue)
	{
 ?>
<button type="submit" name="SYS900" class="btn0" tabindex=900>ユーザ管理</button><br>
<button type="submit" name="SYS910" class="btn0" tabindex=910>部署変更</button><br>
<button type="submit" name="SYS920" class="btn0" tabindex=920>部署管理</button><br>
<?php
	}
 ?>
<button type="submit" name="SYS980" class="btn0" tabindex=980>パスワード変更</button><br>
<?php
		}

	}


	//処理実行部
	$play = new pSysMenuMain("メインメニュー");
	$play->display();

?>
