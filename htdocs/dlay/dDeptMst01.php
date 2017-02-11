<?php
	/**
	 * dDeptMst01
	 *  部署マスタの全件検索（未削除データ）
	 *  Input:
	 *		無し
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/11
	 */
	class dDeptMst01 extends fwDBase01
	{
		protected $sql = 'SELECT * FROM dept_mst WHERE delflg = 0 ORDER BY deptid';

		//Dao生成
		protected function createDao()
		{
			return(new daoDeptMst());
		}
	}

?>
