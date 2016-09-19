create database student;
use student;
create table students(
	id char(8) not null primary key,
	name char(15) not null,
	subject char(15) not null,
	mail char(30) not null,
	schedule char(10) not null,
	introduce char(50) not null,
	state char(5) not null
	)ENGINE=InnoDB DEFAULT CHARSET=utf8;
grant select, insert, update
 	on student.*
	to lilu identified by 'lilu1101';