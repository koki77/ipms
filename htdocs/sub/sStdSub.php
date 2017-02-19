<?php
/**
 * sStdsub
 *  標準サブルーチン群
 * author      Koki
 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
 * since       2016/02/04
 */

	//画面遷移処理
	function goNext($next)
	{
		$_SESSION["SysPrev"] = $_SERVER["PHP_SELF"];
		header("Location:".$next);
		exit;
	}

	//メインメニューへ遷移
	function goMainMenu()
	{
		if(isset($_SESSION["MainMap"]))
		{
			goNext($_SESSION["MainMap"]);
		}else{
			goNext("pSysMenuMain.php");
		}
	}

	//ログイン画面へ遷移
	function goLogin()
	{
		if(isset($_SESSION["LoginMap"]))
		{
			goNext($_SESSION["LoginMap"]);
		}else{
			goNext("index.php");
		}
	}

	//メッセージ取得
	function getMsg($dbc,$msgId)
	{
		//$msg = "ユーザ名またはパスワードが間違っています。";

		$dMsg00 = new dMsg00($dbc);
		$dMsg00->setSelectPrm($msgId);
		$daoMsg = $dMsg00->select();
		if($daoMsg == null)
		{
			$msg = "該当するメッセージが存在しません。";
		}else{
			$msg = $daoMsg->getMsg();
		}

		return($msgId.":".$msg);
	}

	//セッションチェック
	function sessionCheck()
	{
		session_start();
		if($_SESSION["userId"] == "")
		{
			goLogin();
		}
	}

	//異常終了
	function abend()
	{
		print("システムエラー");
		die();
	}

	//文字列チェック(半角英数)
	function checkAscii($str)
	{
		if(preg_match("/\W/",$str))
		{
			return(false);
		}else{
			return(true);
		}
	}

	//名チェック(空白のみの場合エラー)
	function checkName($str)
	{
		if(preg_match("/ /",$str))
		{
			return(false);
		}
		if(preg_match("/　/",$str))
		{
			return(false);
		}
		return(true);

	}

	//IPアドレス形式チェック
	function checkIpAddr($str)
	{
		$addrArray1 = explode(".",$str);
		if(count($addrArray1) != 4)
		{
			return(false);
		}

		if(ctype_digit($addrArray1[0]) == false)
		{
			return(false);
		}

		if(ctype_digit($addrArray1[1]) == false)
		{
			return(false);
		}

		if(ctype_digit($addrArray1[2]) == false)
		{
			return(false);
		}

		if(ctype_digit($addrArray1[3]) == false)
		{
			return(false);
		}

		$addrArray2[0] = intval($addrArray1[0]);
		$addrArray2[1] = intval($addrArray1[1]);
		$addrArray2[2] = intval($addrArray1[2]);
		$addrArray2[3] = intval($addrArray1[3]);

		if($addrArray2[0] < 0 || $addrArray2[0] > 255)
		{
			return(false);
		}

		if($addrArray2[1] < 0 || $addrArray2[1] > 255)
		{
			return(false);
		}

		if($addrArray2[2] < 0 || $addrArray2[2] > 255)
		{
			return(false);
		}

		if($addrArray2[3] < 0 || $addrArray2[3] > 255)
		{
			return(false);
		}

		return(true);

	}

	//IPアドレス編集
	function editAddr($addr1,$addr2,$addr3,$addr4)
	{
		return($addr1.".".$addr2.".".$addr3.".".$addr4);
	}

?>
