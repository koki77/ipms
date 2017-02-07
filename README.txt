利用の準備

yumで以下のパッケージを導入する
httpd
php
php-mbstring
php-pdo
php-mysql

テーブルヘッダスクロールのためjQueryを利用
以下のパスに格納する
 jquery/jquery-1.10.2.min.js
 jquery/jquery.floatThead.js
IE8対策で1.10.2を利用しているがjQueryサイトからは3.x.xしかダウンロードできないので
githubのjquery/jqueryから入手する

httpd.confに以下を追記する
これでサブルーチンやクラス定義の自動読み込みする
<Directory "コンテンツ格納ディレクトリ">
    php_value auto_prepend_file sub/sAutoLoad.php
</Directory>

MariaDBの文字コードはutf8に設定
[mysqld]
character-set-server = utf8
