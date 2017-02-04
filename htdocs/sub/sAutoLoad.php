<?php
/**
 * sAutoLoad
 *  クラスファイル自動ロードサブルーチン
 * author      Koki
 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
 * since       2016/02/04
 */
	require_once("sub/sStdSub.php");
	require_once("sub/sCstTbl.php");

	function myAutoload($className)
	{
    if(preg_match("/^fw/",$className))
		{
			require_once("framework/".$className.".php");
		}else if(preg_match("/^dao/",$className))
		{
			require_once("dao/".$className.".php");
		}else if(preg_match("/^d/",$className)){
			require_once("dlay/".$className.".php");
		}else if(preg_match("/^f/",$className)){
			require_once("flay/".$className.".php");
		}else if(preg_match("/^p/",$className)){
			require_once($className.".php");
		}
	}

	spl_autoload_register('myAutoload');
?>
