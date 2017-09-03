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
	const DeptAdminIdx = 1;
	const NwAdmin = "auth02";
	const NwAdminIdx = 2;

	//定数定義
	const FlgTrue = 1;
	const FlgFalse = 0;
	const FlgHistory = 2;
	const FlgDummy = 3;
	const DeptAll = -1;

	//アドレス重複区分
	const DupKbNG = 1;
	const DupKbNw1NG = 2;
	const DupKbOK = 3;

	//ホスト更新区分
	const HostUpdNone = 1;
	const HostUpdReserve = 2;
	const HostUpdDelete = 3;
	const HostUpdIPAdd = 4;
	const HostUpdIPChange = 5;
	const HostUpdIPDel = 6;
	const HostUpdNameChange = 7;

	//入力長
	const UserIdLen = 20;
	const PassLen = 20;
	const NameLen = 10;
	const DeptLen = 40;
	const NwLen = 40;
	const NwTextLen = 100;
	const HostLen = 50;
	const HostTextLen = 100;
	const SortInterval = 10;
	const YYLen = 4;
	const MMLen = 2;
	const DDLen = 2;
	const GkLen = 7;

?>
