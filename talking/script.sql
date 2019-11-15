 
Create table administrador (
	administrador_id Int NOT NULL AUTO_INCREMENT,
	administrador_nome Varchar(50) NOT NULL,
	administrador_CPF Varchar(14) NOT NULL UNIQUE,
	administrador_email Varchar(40) NOT NULL UNIQUE,
	administrador_celular Varchar(15) NOT NULL,
	administrador_status Char(1) default 'A',
	administrador_senha Varchar(250) NOT NULL,
	tipo_id Int NOT NULL,

 Primary Key (administrador_id)) ENGINE = InnoDB;

 
Create table docente (
	docente_id Int NOT NULL AUTO_INCREMENT,
	docente_nome Varchar(50) NOT NULL,
	docente_CPF Varchar(14) NOT NULL UNIQUE,
	docente_email Varchar(40) NOT NULL UNIQUE,
	docente_celular Varchar(15) NOT NULL,
	docente_status Char(1) default 'A',
	docente_senha Varchar(250) NOT NULL,
	tipo_id Int NOT NULL,

 Primary Key (docente_id)) ENGINE = InnoDB;

 

Create table tipo_pessoa (
	tipo_id Int NOT NULL AUTO_INCREMENT,
	tipo_pessoa Varchar(20) default 'Usuário',

 Primary Key (tipo_id)) ENGINE = InnoDB;


insert into tipo_pessoa (tipo_pessoa) values ('Coordenador(a)'), ('Diretor(a)'), ('Professor(a)'), ('Responsável');


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
	docente_id Int NOT NULL,
	disciplina_id Int NOT NULL,
 Primary Key (pessoa_disciplina_id)) ENGINE = InnoDB;




Alter table administrador add Foreign  key (tipo_id) references tipo_pessoa (tipo_id);

Alter table docente add Foreign  key (tipo_id) references tipo_pessoa (tipo_id);

Alter table aluno add Foreign Key (turma_id) references turma (turma_id);

Alter table pessoa_disciplina add Foreign Key (docente_id) references docente (docente_id);

Alter table pessoa_disciplina add Foreign Key (disciplina_id) references disciplina (disciplina_id);

