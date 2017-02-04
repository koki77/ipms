CREATE TABLE user_mst(
userid varchar(20) NOT NULL,
passwd varchar(100) NOT NULL,
deptid int,
usernm varchar(100) NOT NULL,
delflg int,
PRIMARY KEY(userid)
);

INSERT INTO user_mst (userid,passwd,deptid,usernm,delflg)
 VALUES
('admin','YWRtaW4=',0,'システム管理者',0),
('test','dGVzdA==',1,'テストユーザ',0);

