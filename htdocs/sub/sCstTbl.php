<?php
/**
 * sCstTbl
 *  定数定義
 * author      Koki
 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
 * since       2016/02/04
 */

	//DB接続情報
	const DbUser = "ipms";
	const DbPass = "ip@pw12";
	const DbDns = "mysql:host=localhost;dbname=ipmsdb;charset=utf8mb4";

	//権限定数
	const SysAdmin = "sysadmin";
	const DeptAdmin = "auth01";
	const NwAdmin = "auth02";

	//定数定義
	const FlgOn = 1;
	const FlgOff = 0;
	const FlgTrue = 1;
	const FlgFalse = 0;
	const DeptAll = -1;

	const UserIdLen = 20;
	const PassLen = 20;
	const MsgIdLen = 6;
	const NaiyoLen = 15;
	const MsgLen = 50;
	const NameLen = 10;
	const YYLen = 4;
	const MMLen = 2;
	const DDLen = 2;
	const GkLen = 7;
	const KosuLen = 3;

?>
