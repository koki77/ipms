<?php
	/**
	 * dNw1Mst02
	 *  大分類ネットワークマスタのソート順最大値取得（未削除データ）
	 *  Input:
	 *		無し
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/16
	 */
	class dNw1Mst02 extends fwDBase50
	{
		protected $sql = 'SELECT max(sortnum) as maxval FROM nw1_mst WHERE delflg = 0';

		//Dao生成
		protected function createDao()
		{
			return(new daoMax01());
		}
	}

?>
