<?php
	/**
	 * pSysMenuMain
	 *  メインメニュー
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * version     v 1.00 2016/02/04
	 */
	//クラス定義部
	class pSysMenuMain extends fwPBase00
	{
		//初期化処理
		protected function init()
		{
			//仮置き
			$this->flay = new fwFBase00("dummy","dummy");
		}

		//開始処理
		protected function startProc()
		{
			if(isset($_POST["SYS010"]))
			{
				goNext("pMemMemberAdd.php");
			}else if(isset($_POST["SYS110"])){
				$_SESSION["Mode"] = "YOSAN";
				goNext("pKaiKaikeiList.php");
			}else if(isset($_POST["SYS120"])){
				$_SESSION["Mode"] = "KESSAN";
				goNext("pKaiKaikeiList.php");
			}else if(isset($_POST["SYS130"])){
				$_SESSION["Mode"] = "KARI";
				goNext("pKaiKaikeiList.php");
			}else if(isset($_POST["SYS140"])){
				goNext("pKaiDanpiSet.php");
			}else if(isset($_POST["SYS900"])){
				goNext("pSysUserList.php");
			}else if(isset($_POST["SYS980"])){
				$_SESSION["SysUserId"] = $_SESSION["userId"];
				$_SESSION["Mode"] = "UPDATE";
				goNext("pSysUserEdit.php");
			}
		}

		//主表示領域表示
		protected function dspMain()
		{
?>
<button type="submit" name="SYS010" class="btn1" tabindex=010>入団者登録</button><br>
<button type="submit" name="SYS110" class="btn1" tabindex=110>予算編成</button><br>
<button type="submit" name="SYS120" class="btn1" tabindex=120>決算処理</button><br>
<button type="submit" name="SYS130" class="btn1" tabindex=130>決算解除</button><br>
<button type="submit" name="SYS140" class="btn1" tabindex=140>団費調定</button><br>
<button type="submit" name="SYS900" class="btn1" tabindex=900>ユーザ管理</button><br>
<button type="submit" name="SYS980" class="btn1" tabindex=980>パスワード変更</button><br>
<?php
		}

	}


	//処理実行部
	$play = new pSysMenuMain("メインメニュー");
	$play->display();

?>
