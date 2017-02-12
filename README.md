
## ipms - ip address management system


## 概要

* ipアドレスをwebで管理する
* 現状はCentOSでの動作をサポートしています

## インストール方法

### 前提パッケージの導入

1. 前提パッケージを導入します

    ```sh
    [root@CentOS7 ~]# yum install git httpd php php-mbstrings php-pdo php-mysql mariadb mariadb-server
    ```

### ipms導入からhttpdの起動まで

1. ipmsの導入

    ```sh
    [root@CentOS7 ~]# cd /var/www/html
    [root@CentOS7 html]# git clone https://github.com/koki77/ipms.git
    ```
1. jQueryの導入

    * ディレクトリの作成
    ```sh
    [root@CentOS7 ~]# cd /var/www/html/ipms/htdocs
    [root@CentOS7 htdocs]# mkdir jquery
    [root@CentOS7 htdocs]# cd jquery
    [root@CentOS7 jquery]# pwd
    /var/www/html/ipms/htdocs/jquery
    [root@CentOS7 jquery]#
    ```

    * jquery-1.10.2.min.js の導入
    ```sh
    [root@CentOS7 jquery]# wget http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js
    [root@CentOS7 jquery]# mv jquery.min.js jquery-1.10.2.min.js
    ```

    * jquery.floatThead.js の導入
    ```sh
    [root@CentOS7 jquery]# wget https://cdnjs.cloudflare.com/ajax/libs/floatthead/2.0.1/jquery.floatThead.js
    ```

1. httpd.confの修正

    サブルーチンやクラス定義の自動読み込みのため
    /etc/httpd/conf.d/へipms.confを作成する
    ```sh
    [root@CentOS7 ~]# vi /etc/httpd/conf.d/ipms.conf
    <Directory "/var/www/html/ipms/htdocs/">
      php_value auto_prepend_file sub/sAutoLoad.php
    </Directory>
    ```
1. httpdの起動
    ```sh
    [root@CentOS7 ~]# systemctl start httpd.service
    ```

###  MariaDBのセットアップ

1. my.cnfの修正

    キャラセットをutf8に変更するため/etc/my.cnfへ以下の１行追記
    ```
    character-set-server=utf8
    ```
1. MariaDBの起動
    ```sh
    [root@CentOS7 htdocs]# systemctl start  mariadb.service
    ```

1. MariaDBの初期設定
    ```sh
    [root@CentOS7 etc]# mysql_secure_installation
    ```

### ipms用DBの準備

1. DBの初期設定
    ```sh
    [root@CentOS7 ~]# /var/www/html/ipms/sql
    [root@CentOS7 sql]# mysql -u root -p  < init_db.sql
    Enter password:
    [root@CentOS7 sql]#
    ```
1. テーブルの作成

    ```sh
    [root@CentOS7 sql]# mysql -u ipms -p ipmsdb < dept_mst.sql
    [root@CentOS7 sql]# mysql -u ipms -p ipmsdb < msg.sql
    [root@CentOS7 sql]# mysql -u ipms -p ipmsdb < user_mst.sql
    ```
