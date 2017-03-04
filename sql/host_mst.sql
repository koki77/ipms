CREATE TABLE host_mst(
host_id int AUTO_INCREMENT,
history_no int,
host_nm varchar(50),
host_text varchar(100),
host_type int,
update_kb int,
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
PRIMARY KEY(host_id,history_no)
);

CREATE INDEX host_mst_idx01 on host_mst(
  host_nm
);
