create database trabalhophp;
use trabalhophp;
alter database trabalhophp character set utf8 collate utf8_general_ci;

create table if not exists tab_ficha (
cod_ficha int not null auto_increment primary key,
nome varchar(50),
cpf varchar(13),
email varchar(100) 
);

select * from tab_ficha;