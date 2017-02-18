<?php
	/**
	 * index
	 *  ログイン画面
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/04
	 */
	//セッション初期化
	session_start();
	// セッション変数を全て解除する
	$_SESSION = array();
	// セッションを切断するにはセッションクッキーも削除する。
	// Note: セッション情報だけでなくセッションを破壊する。
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-42000, '/');
	}
	// 最終的に、セッションを破壊する
	session_destroy();
	//処理開始
	session_start();

	$_SESSION["userId"] = "";
	$_SESSION["LoginMap"] = "index.php";
	$_SESSION["MainMap"] = "pSysMenuMain.php";

	$disp = false;

	//認証処理
	if(isset($_POST["login"]))
	{
		$fSysLogin = new fSysLogin("dummy");
		$fSysLogin->setUserId($_POST["userid"]);
		$fSysLogin->setPassword($_POST["pass"]);
		$fSysLogin->run();
		if($fSysLogin->getResult())
		{
			$_SESSION["userId"] = $_POST["userid"];
			$flay = new fSysUserDisplay("dummy");
			$flay->setUserId($_SESSION["userId"]);
			$flay->run();
			$_SESSION["userName"] = $flay->getDisplayUserName();
			$_SESSION["deptId"] = $flay->getDeptId();
			goMainMenu();
		}else{
			$disp = true;
		}
	}
?>

<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="style.css" type="text/css">
<script type="text/javascript" src="framework/playFunc.js"></script>
</head>
<body>

<div class="base">

<div class="main">
<form method="post" action="">

<TABLE>
<TR>
<TD align="right">ユーザＩＤ：</TD>
<TD>
<input type="text" name="userid" value="<?php  if($disp == true){ print($_POST["userid"]); }?>">
</TD>
</TR>

<TR>
<TD align="right">パスワード</TD>
<TD><input type="password" name="pass"></TD>
</TR>

<TR>
<TD></TD>
<TD><button type="submit" name="login" class="btn1">ログイン</button></TD>
</TR>
</TABLE>

</form>

</div>

<div class="footer" align="center">
<?php
		if($disp == true)
		{
			print($fSysLogin->getMessage());
		}
?>
</div>

</div>

</body>
</html>
