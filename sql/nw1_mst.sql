CREATE TABLE nw1_mst(
nw1_id int,
sortnum int,
nwnm varchar(100) NOT NULL,
nwtext varchar(300),
delflg int,
create_userid  varchar(20) NOT NULL,
create_usernm  varchar(100) NOT NULL,
create_deptid int,
create_deptnm varchar(100),
create_date datetime,
update_userid  varchar(20) NOT NULL,
update_usernm  varchar(100) NOT NULL,
update_deptid int,
update_deptnm varchar(100),
update_date datetime,
PRIMARY KEY(nw1_id)
);
