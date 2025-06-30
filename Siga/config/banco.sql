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




create table disciplina
(id int primary key auto_increment,
nome varchar(250));

alter table atividade
add column idDisciplina int,
add foreign key fkDisciplina (idDisciplina) references disciplina (id);





alter table atividade
modify column tipo varchar(10);

update atividade 
set tipo = 1, recuperacao = 7
where id = 10;

desc atividade;

select * from  atividade;

