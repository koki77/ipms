CREATE TABLE user_mst(
userid varchar(20) NOT NULL,
passwd varchar(100) NOT NULL,
deptid int,
usernm varchar(100) NOT NULL,
sysadmin int,
auth01 int,
auth02 int,
auth03 int,
auth04 int,
auth05 int,
auth06 int,
auth07 int,
auth08 int,
auth09 int,
auth10 int,
delflg int,
PRIMARY KEY(userid)
);

INSERT INTO user_mst (userid,passwd,deptid,usernm,sysadmin,auth01,auth02,auth03,auth04,auth05,auth06,auth07,auth08,auth09,auth10,delflg)
 VALUES
('admin','YWRtaW4=',0,'システム管理者',1,0,0,0,0,0,0,0,0,0,0,0),
('test','dGVzdA==',1,'テストユーザ',0,0,0,0,0,0,0,0,0,0,0,0),
('test1','dGVzdA==',1,'テストユーザ１',0,1,0,0,0,0,0,0,0,0,0,0),
('test2','dGVzdA==',1,'テストユーザ２',0,0,1,0,0,0,0,0,0,0,0,0),
('test3','dGVzdA==',1,'テストユーザ３',0,0,0,0,0,0,0,0,0,0,0,0),
('test4','dGVzdA==',1,'テストユーザ４',0,0,0,0,0,0,0,0,0,0,0,0),
('test5','dGVzdA==',1,'テストユーザ５',0,0,0,0,0,0,0,0,0,0,0,0),
('test6','dGVzdA==',1,'テストユーザ６',0,0,0,0,0,0,0,0,0,0,0,0),
('test7','dGVzdA==',1,'テストユーザ７',0,0,0,0,0,0,0,0,0,0,0,0),
('test8','dGVzdA==',1,'テストユーザ８',0,0,0,0,0,0,0,0,0,0,0,0),
('test9','dGVzdA==',1,'テストユーザ９',0,0,0,0,0,0,0,0,0,0,0,0),
('test10','dGVzdA==',1,'テストユーザ１０',0,0,0,0,0,0,0,0,0,0,0,0),
('test11','dGVzdA==',1,'テストユーザ１１',0,0,0,0,0,0,0,0,0,0,0,0),
('test12','dGVzdA==',1,'テストユーザ１２',0,0,0,0,0,0,0,0,0,0,0,0),
('test13','dGVzdA==',1,'テストユーザ１３',0,0,0,0,0,0,0,0,0,0,0,0),
('test14','dGVzdA==',1,'テストユーザ１４',0,0,0,0,0,0,0,0,0,0,0,0),
('test15','dGVzdA==',1,'テストユーザ１５',0,0,0,0,0,0,0,0,0,0,0,0);
