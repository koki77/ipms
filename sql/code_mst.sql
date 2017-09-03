﻿
CREATE TABLE code_mst(
codekb int,
codeid int,
codename varchar(50) NOT NULL,
PRIMARY KEY (codekb,codeid)
);




INSERT INTO code_mst
 VALUES

(0,1,'アドレス重複区分'),
(1,1,'重複不可'),
(1,2,'大分類内のみ重複不可'),
(1,3,'重複可（クローズネットワーク）'),
(0,2,'ネットマスク'),
(2,24,'255.255.255.0'),
(2,25,'255.255.255.128'),
(2,26,'255.255.255.192'),
(2,27,'255.255.255.224'),
(2,28,'255.255.255.240'),
(2,29,'255.255.255.248'),
(2,30,'255.255.255.252'),
(0,3,'機器種別'),
(3,10,'サーバ'),
(3,20,'サーバシャーシ'),
(3,30,'ストレージ'),
(3,40,'SANスイッチ'),
(3,50,'負荷分散装置'),
(3,60,'ファイアウォール'),
(3,70,'スイッチ'),
(3,80,'ルータ'),
(3,900,'その他'),
(0,4,'ホスト更新区分'),
(4,1,'ホスト名未設定'),
(4,2,'ホスト名予約'),
(4,3,'ホスト削除'),
(4,4,'IPアドレス追加'),
(4,5,'IPアドレス引継ぎ'),
(4,6,'IPアドレス返却'),
(4,7,'ホスト名変更'),
(0,5,'ホスト種別'),
(5,1,'実ホスト名'),
(5,2,'クラスタ仮想'),
(5,3,'負荷分散仮想'),
(5,4,'別名ホスト'),
(5,5,'NAT');
