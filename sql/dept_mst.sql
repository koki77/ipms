CREATE TABLE dept_mst(
deptid int AUTO_INCREMENT,
deptnm varchar(100) NOT NULL,
delflg int,
PRIMARY KEY(deptid)
);

INSERT INTO dept_mst (deptnm,delflg)
 VALUES
('テスト部門',0);

