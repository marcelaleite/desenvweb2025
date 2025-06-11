create database siga;
use siga;

create table atividade(
id int auto_increment primary key,
descricao varchar(250),
peso decimal(16,2),
anexo varchar(250) );

select * 
  from atividade
 where descricao like '%prova%';
-- script de criação do banco de dados

alter table atividade
add column tipo int,
add column recuperacao decimal(16,2),
add column equipe varchar(250);

update atividade 
set tipo = 1, recuperacao = 7
where id = 10;
