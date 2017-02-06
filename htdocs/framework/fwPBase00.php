<?php
	/**
	 * fwPBase00
	 *  画面表示基底クラス(単件表示)
	 * author      Kok
	 * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
	 * since       2016/02/04
	 */
	class fwPBase00
	{
		protected $flay;
		private $msg;
		private $userName;
		protected $title;
		protected $flayCall;
		//初期化
		public function __construct($title)
		{
			sessionCheck();
			if(isset($_POST["logout"]))
			{
				goLogin();
			}
			$this->title = $title;
			$this->userName = $_SESSION["userName"];
			$this->flayCall = true;
			if(isset($_SESSION["SysMsg"]))
			{
				$this->setMessage($_SESSION["SysMsg"]);
				unset($_SESSION["SysMsg"]);
			}
			$this->init();
			$this->startProc();
		}
		//初期化処理
		protected function init()
		{
		}
		//開始処理
		protected function startProc()
		{
		}
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
		//ヘッダー表示
		protected function dspHeader()
		{
?>
<html>
<head>
<title><?php print($this->title); ?></title>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Expires" content="0">
<link rel="stylesheet" href="style.css" type="text/css">
<script type="text/javascript" src="framework/playFunc.js"></script>
<script src="jquery/jquery-1.10.2.min.js"></script>
<script src="jquery/jquery.floatThead.js"></script>
<script type="text/javascript">
	jQuery(function(){
		jQuery('table.headfloat').floatThead();
	});
</script>
</HEAD>
<body>
<form method="post" action="" name="main">
<div class="base">

<div class="header">
<div class="header-user">
<button type="submit" name="logout" class="btn1" tabindex=9999>ログアウト</button><BR>
<?php print($this->userName);?>
</div>
<div class="header-main">
<H1><?php print($this->title); ?></H1>
</div>
</div>

<BR>
<hr>

<div class="main">
<?php
		}
		//主表示領域表示
		protected function dspMain()
		{
		}
		//フッター表示
		protected function dspFooter()
		{
?>
</div>
<hr>
<div class="footer">
<?php print($this->msg); ?>
</div>

</div>
</form>
</body>
</html>
<?php
		}
		public function setMessage($msg)
		{
			if($this->msg == "")
			{
				$this->msg = $msg;
			}
		}
	}
?>
