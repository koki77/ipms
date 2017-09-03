<?php
	/**
	 * dDeptMst02
	 *  部署マスタの検索（指定データ）
	 *  Input:
	 *		deptId
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2017/02/11
	 */
	class dDeptMst02 extends fwDBase02
	{
		protected $sql = 'SELECT * FROM dept_mst WHERE deptid = ?';

		//Dao生成
		protected function createDao()
		{
			return(new daoDeptMst());
		}

		//検索キー設定
		public function setSelectPrm($deptid)
		{
			$this->prm = array($deptid);
		}
	}

?>
