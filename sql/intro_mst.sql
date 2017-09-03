#設備導入情報マスタ
CREATE TABLE intro_mst(
intro_id int AUTO_INCREMENT,
intro_cd varchar(100),
intro_nm varchar(100),
intro_date date,
delflg int,
PRIMARY KEY(intro_id)
);
