 <?php
 /**
  * sAuthority
  *  権限判定サブルーチン群
  * author      Koki
  * environment PHP 5.4.16/Apache 2.4.6/MariaDB 5.5.52
  * since       2016/02/04
  */

  //権限設定
  function authoritySet($dao)
  {
    $_SESSION["sysadmin"] = $dao->getSysadmin();
    $_SESSION["auth01"] = $dao->getAuth01();
    $_SESSION["auth02"] = $dao->getAuth02();
    $_SESSION["auth03"] = $dao->getAuth03();
    $_SESSION["auth04"] = $dao->getAuth04();
    $_SESSION["auth05"] = $dao->getAuth05();
    $_SESSION["auth06"] = $dao->getAuth06();
    $_SESSION["auth07"] = $dao->getAuth07();
    $_SESSION["auth08"] = $dao->getAuth08();
    $_SESSION["auth09"] = $dao->getAuth09();
    $_SESSION["auth10"] = $dao->getAuth10();
  }

  //権限取得
  function authorityGet($index)
  {
    return($_SESSION[$index]);
  }
?>
