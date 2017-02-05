利用の準備

yumで以下のパッケージを導入する
httpd
php
php-mbstring
php-pdo
php-mysql

httpd.confに以下を追記する
これでサブルーチンやクラス定義の自動読み込みする
<Directory "コンテンツ格納ディレクトリ">
    php_value auto_prepend_file sub/sAutoLoad.php
</Directory>