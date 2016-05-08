CREATE TABLE rp_users(
id int not null primary key,
user_login varchar(60) not null,
user_pass varchar(64) not null,
user_email varchar(100) not null,
user_status int not null,
user_rol varchar(50) not null
)

SELECT * FROM rp_users

alter table rp_users
  add user_rol varchar(50)

INSERT INTO rp_users VALUES (1, 'admin', 'sysadmin', 'noemail@rpluer.com', 1, 'admin')