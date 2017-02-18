<?php
	/**
	 * fwPBase01
	 *  画面表示基底クラス(明細表示)
	 * author      Koki
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/04
	 */
	class fwPBase01 extends fwPBase00
	{
		private $listHeight;
		protected $max;
		protected $cnt;

		//画面表示
		public function display()
		{
			if($this->flayCall == true)
			{
				$this->flay->run();
			}
			$this->dspHeader();
			$this->dspMain();
			$this->dspFooter();
		}

		//主表示領域表示
		protected function dspMain()
		{
			?>
			<div class="button">
			<?php
			$this->dspButton();
			?>
			</div>
			<?php
			$this->dspMainTop();
			$this->dspList();
			$this->dspMainBottom();
		}

		//主表示領域上段表示
		protected function dspMainTop()
		{
		}

		//主表示領域下段表示
		protected function dspMainBottom()
		{
		}

		//明細行数設定
		protected function setMaxLine($max)
		{
			$this->max = $max;
		}

		//明細表示
		private function dspList()
		{
			$this->cnt = 0;
			while($this->max > $this->cnt)
			{

				if($this->cnt%2 == 0)
				{
?>
<TR class="color1">
<?php
				}else{
?>
<TR class="color2">
<?php
				}
				$this->dspLine();
?>
</TR>
<?php
				$this->cnt++;
			}
			$this->dspLastLine();
?>
<input type="hidden" name="max" value="<?php print($this->max);?>">
<?php
		}

		//行表示
		protected function dspLine()
		{
		}

		//最終行表示
		protected function dspLastLine()
		{
		}

		//ボタン領域表示
		protected function dspButton()
		{
		}

	}
?>
