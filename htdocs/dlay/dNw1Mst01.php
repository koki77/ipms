<?php
	/**
	 * dNw1Mst01
	 *  大分類ネットワークマスタの全件検索（未削除データ）
	 *  Input:
	 *		無し
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/16
	 */
	class dNw1Mst01 extends fwDBase01
	{
		protected $sql = 'SELECT * FROM nw1_mst WHERE delflg = 0 ORDER BY sortnum';

		//Dao生成
		protected function createDao()
		{
			return(new daoNw1Mst());
		}
	}

?>
