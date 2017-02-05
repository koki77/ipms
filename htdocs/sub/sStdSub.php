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

	//氏名チェック
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

	//日付整合性チェック
	function checkYMD($YY,$MM,$DD)
	{
		//必須入力チェック
		if($YY == "")
		{
			return(1);
		}

		if($MM == "")
		{
			return(2);
		}

		if($DD == "")
		{
			return(3);
		}

		//数値チェック
		if(is_numeric($YY) == false)
		{
			return(4);
		}

		if(is_numeric($MM) == false)
		{
			return(5);
		}

		if(is_numeric($DD) == false)
		{
			return(6);
		}

		//実在日チェック
		if(checkdate($MM,$DD,$YY) == false)
		{
			return(7);
		}
		return(0);

	}

	//カナ文字チェック
	function checkStrKn($str)
	{
		return(preg_match("/^[ァ-ヶー]+$/u",$str));
	}

	//金額編集(画面表示)
	function displayGk($Gk)
	{
		return(number_format($Gk)."　");
	}

	//会計明細金額計算
	function calcGk($tanka,$kosu,$tankaKb)
	{
		//数値チェック
		if(is_numeric($tanka)  == false)
		{
			$tmp1 = 0;
		}else{
			$tmp1 = $tanka;
		}
		if(is_numeric($kosu)  == false)
		{
			$tmp2 = 0;
		}else{
			$tmp2 = $kosu;
		}

		//金額計算
		if($tankaKb == 1 && $kosu == "")
		{
			return($tmp1);
		}else{
			return($tmp1*$tmp2);
		}
	}

	//日付比較 基準日以降ならtrue
	function compDate($ymd,$kijunYmd)
	{
		$yy1 = intval(substr($ymd,0,4));
		$mm1 = intval(substr($ymd,4,2));
		$dd1 = intval(substr($ymd,6,2));
		$yy2 = intval(substr($kijunYmd,0,4));
		$mm2 = intval(substr($kijunYmd,4,2));
		$dd2 = intval(substr($kijunYmd,6,2));
		if($yy1 < $yy2)
		{
			return(false);
		}
		if($yy1 > $yy2)
		{
			return(true);
		}
		if($mm1 < $mm2)
		{
			return(false);
		}
		if($mm1 > $mm2)
		{
			return(true);
		}
		if($dd1 < $dd2)
		{
			return(false);
		}
		return(true);
	}

	//日付計算 日数加減
	function calcDay($ymd,$day)
	{
		$yy = intval(substr($ymd,0,4));
		$mm = intval(substr($ymd,4,2));
		$dd = intval(substr($ymd,6,2));
		//日数加減
		$dd = $dd + $day;

		if($dd < 1)
		{
			while($dd < 1)
			{
				$mm--;
				if($mm == 0)
				{
					$yy--;
					$mm = 12;
				}
				$dd = $dd + getDD($yy,$mm);
			}
		}else{
			while($dd > getDD($yy,$mm))
			{
				$dd = $dd - getDD($yy, $mm);
				$mm++;
				if($mm == 13)
				{
					$yy++;
					$mm = 1;
				}
			}
		}

		return(editDate($yy, $mm, $dd));
	}

	//日数取得
	function getDD($yy,$mm)
	{
		switch ($mm)
		{
			case 1:
			case 3:
			case 5:
			case 7:
			case 8:
			case 10:
			case 12:
				return(31);
				break;
			case 4:
			case 6:
			case 9:
			case 11:
				return(30);
				break;
			default:
				//2月はうるう年判定
				if($yy%400 == 0)
				{
					return(29);
				}else if($yy%100 == 0){
					return(28);
				}else if($yy%4 == 0){
					return(29);
				}else{
					return(28);
				}
				break;
		}

	}

	//日付編集
	function editDate($yy,$mm,$dd)
	{
		$str = strval($yy);
		if($mm < 10)
		{
			$str = $str."0".strval($mm);
		}else{
			$str = $str.strval($mm);
		}
		if($dd < 10)
		{
			$str = $str."0".strval($dd);
		}else{
			$str = $str.strval($dd);
		}
		return($str);
	}
?>
