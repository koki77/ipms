<?php
	/**
	 * dUserMst03
	 *  ユーザマスタの部署指定検索（指定部署以外の未削除データ）
	 *  Input:
	 *		deptid
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/04
	 */
	class dUserMst03 extends fwDBase02
	{
		protected $sql = 'SELECT * FROM user_mst WHERE delflg = 0 and deptid > 0 and deptid != ? ORDER BY userid';

		//Dao生成
		protected function createDao()
		{
			return(new daoUserMst());
		}

		//検索キー設定
		public function setSelectPrm($deptid)
		{
			$this->prm = array($deptid);
		}

	}

?>
