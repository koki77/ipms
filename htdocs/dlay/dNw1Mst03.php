<?php
	/**
	 * dNw1Mst02
	 *  大分類ネットワークマスタのID最大値取得
	 *  Input:
	 *		無し
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/18
	 */
	class dNw1Mst03 extends fwDBase50
	{
		protected $sql = 'SELECT max(nw1_id) as maxval FROM nw1_mst';

		//Dao生成
		protected function createDao()
		{
			return(new daoMax01());
		}
	}

?>
