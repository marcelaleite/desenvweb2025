create database siga;
use siga;

create table atividade(
id int auto_increment primary key,
descricao varchar(250),
peso decimal(16,2),
anexo varchar(250) );


create table usuario(
id int auto_increment primary key,
nome varchar(250),
email varchar(250),
senha varchar(250),
matricula varchar(250),
contato varchar(250) );


select * from atividade;
-- script de criação do banco de dados