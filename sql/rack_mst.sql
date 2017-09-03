#ラック情報マスタ
CREATE TABLE rack_mst(
rackid int AUTO_INCREMENT,
racknm varchar(100) NOT NULL,
unit int,
rack_weight DECIMAL(7,3),
intro_id int,
delflg int,
PRIMARY KEY(rackid)
);
