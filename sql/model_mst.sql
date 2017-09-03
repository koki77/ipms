CREATE TABLE model_mst(
model_id int AUTO_INCREMENT,
model_nm varchar(50),
model_weight DECIMAL(7,3),
machine_type int,
unit_size int,
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
PRIMARY KEY(model_id)
);
