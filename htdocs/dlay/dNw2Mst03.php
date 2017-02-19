<?php
	/**
	 * dNw1Mst02
	 *  小分類ネットワークマスタのID最大値取得
	 *  Input:
	 *		無し
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/18
	 */
	class dNw2Mst03 extends fwDBase50
	{
		protected $sql = 'SELECT max(nwid) as maxval FROM nw2_mst';

		//Dao生成
		protected function createDao()
		{
			return(new daoMax01());
		}
	}

?>
