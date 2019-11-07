CREATE TABLE `administrador` (
  `id_adm` INT NOT NULL AUTO_INCREMENT,
  `nome_adm`  varchar(255) NOT NULL,
  `rg_adm`	  varchar(15) NOT NULL,
  `cpf_adm`	  char(14) NOT NULL,
  `email_adm` varchar(255) NOT NULL,
  `celular_adm` varchar(16) NOT NULL,
  `senha_adm` varchar(255) NOT NULL,

  PRIMARY KEY (`id_adm`)
) ENGINE=InnoDB;

INSERT INTO administrador (nome_adm, rg_adm, cpf_adm, email_adm, celular_adm, md5(senha_adm)) values
("Lucas", '56425941-x', '12345678912345', 'casarotti@hotmail.com', '996762768', '123456');

CREATE TABLE `aluno` (
  `id_aluno` INT NOT NULL AUTO_INCREMENT,
  `nome_aluno`  varchar(255) NOT NULL,
  `ra_aluno`  varchar(255) NOT NULL,
  `responsavel_aluno`	  varchar(15) NOT NULL,
  `turma_aluno`	  char(1) NOT NULL,
  `serie_aluno` varchar(255) NOT NULL,
 

  PRIMARY KEY (`id_aluno`)
) ENGINE=InnoDB;