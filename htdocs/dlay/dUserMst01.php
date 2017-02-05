<?php
	/**
	 * dUserMst01
	 *  ユーザマスタの全件検索（未削除データ）
	 *  Input:
	 *		無し
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/04
	 */
	class dUserMst01 extends fwDBase01
	{
		protected $sql = 'SELECT * FROM user_mst WHERE delflg = 0 ORDER BY deptid,userid';

		//Dao生成
		protected function createDao()
		{
			return(new daoUserMst());
		}
	}

?>
