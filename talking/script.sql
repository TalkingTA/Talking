 
Create table pessoa (
	pessoa_id Int NOT NULL AUTO_INCREMENT,
	pessoa_nome Varchar(50) NOT NULL,
	pessoa_CPF Varchar(14) NOT NULL UNIQUE,
	pessoa_email Varchar(40) NOT NULL UNIQUE,
	pessoa_celular Varchar(15) NOT NULL,
	pessoa_imagem Blob,
	pessoa_status Char(1) default 'A',
	pessoa_senha Varchar(250) NOT NULL,
	tipo_id Int NOT NULL

 Primary Key (pessoa_id)) ENGINE = InnoDB;
 

Create table tipo_pessoa (
	tipo_id Int NOT NULL AUTO_INCREMENT,
	tipo_pessoa Varchar(20) default 'Usuário',

 Primary Key (tipo_id)) ENGINE = InnoDB;

insert into tipo_pessoa (tipo_pessoa) values ('Coordenador(a)'), ('Diretor(a)'), ('Professor(a)');


Create table turma (
	turma_id Int NOT NULL AUTO_INCREMENT,
	turma_serie Varchar(10) NOT NULL,
	turma_descricao Char(1) NOT NULL,
	turma_periodo Varchar(8) NOT NULL,
 Primary Key (turma_id)) ENGINE = InnoDB;


Create table disciplina (
	disciplina_id Int NOT NULL AUTO_INCREMENT,
	disciplina_descricao Varchar(20) NOT NULL,
 Primary Key (disciplina_id)) ENGINE = InnoDB;

Create table aluno (
	aluno_id Int NOT NULL AUTO_INCREMENT,
	aluno_ra Varchar(20) NOT NULL,
	aluno_idade Int NOT NULL,
	aluno_sexo Char(1) NOT NULL,
	aluno_responsavel Varchar(45) NOT NULL,
	aluno_status Char(1) default 'A',
	turma_id Int NOT NULL,
 Primary Key (aluno_id)) ENGINE = InnoDB;


Create table pessoa_disciplina (
	pessoa_disciplina_id Int NOT NULL AUTO_INCREMENT,
	pessoa_id Int NOT NULL,
	disciplina_id Int NOT NULL,
 Primary Key (pessoa_disciplina_id)) ENGINE = InnoDB;



-- Alter table pessoa add Foreign Key (tipo_id) references tipo_pessoa (tipo_id);

Alter table aluno add Foreign Key (turma_id) references turma (turma_id);

Alter table pessoa_disciplina add Foreign Key (pessoa_id) references pessoa (pessoa_id);

Alter table pessoa_disciplina add Foreign Key (disciplina_id) references disciplina (disciplina_id);


insert into pessoa (pessoa_nome, pessoa_cpf, pessoa_email, pessoa_celular, pessoa_senha, tipo_id) values ('Lucas', 555, 'a@hotmail.com', 9595, '123', 1);
