/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  user
 * Created: 2021.09.28.
 */
CREATE TABLE IF NOT EXISTS `ci_sessions` (
        `id` varchar(128) NOT null,
        `ip_address` varchar(45) NOT null,
        `timestamp` timestamp DEFAULT CURRENT_TIMESTAMP NOT null,
        `data` blob NOT null,
        KEY `ci_sessions_timestamp` (`timestamp`)
);

CREATE TABLE employees(
    id INT NOT NULL AUTO_INCREMENT, 
    name VARCHAR(500) NOT NULL, 
    tin CHAR(10) NOT NULL, 
    ssn CHAR(9) NOT NULL, 
    sex CHAR(1) NOT NULL, 
    
    CONSTRAINT PK_employees PRIMARY KEY(id), 
    CONSTRAINT UQ_employees_tin UNIQUE(tin), 
    CONSTRAINT UQ_employees_ssn UNIQUE(ssn)
);

INSERT INTO employees(name, sex, ssn, tin)
values ('Emp 01', 'M','111010','2333');


create table sexes(
	id char(1), 
    name varchar(200) not null, 
    
    constraint PK_sexes PRIMARY KEY(id)
);
insert into sexes(id, name) values('M', 'Male');
insert into sexes(id,name) values('F', 'Female');

alter table employees 
drop sex;

alter table employees
add sex_id CHAR(1);

ALTER TABLE employees
add CONSTRAINT FK_employees_sex_id FOREIGN KEY(sex_id) references sexes(id);