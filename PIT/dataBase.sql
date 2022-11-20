CREATE TABLE pessoa
(
   codigo	int PRIMARY KEY auto_increment,
   nome varchar(100) NOT NULL,
   sexo char(1) NOT NULL,
   email varchar(100) UNIQUE,
   telefone varchar(20) NOT NULL,
   cep varchar(10),
   logradouro varchar(100),
   cidade varchar(50),
   estado char(2)
) ENGINE=InnoDB;
 
CREATE TABLE funcionario
(
   dataContrato date NOT NULL,
   salario int NOT NULL,
   senhaHash varchar(256) NOT NULL,
   codigo int PRIMARY KEY,
   CONSTRAINT funcFk FOREIGN KEY (codigo)
   	REFERENCES pessoa (codigo)
      ON UPDATE CASCADE
      ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE medico
(
   codigo int PRIMARY KEY,
   especialidade varchar(30) NOT NULL,
   crm varchar(30) NOT NULL UNIQUE,
   CONSTRAINT medFk FOREIGN KEY (codigo)
        REFERENCES funcionario (codigo)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE agenda
(
   codigo int PRIMARY KEY auto_increment,
   dataAgenda date NOT NULL,
   horario smallint NOT NULL,
   nome varchar(100) NOT NULL,
   sexo char(1) NOT NULL,
   email varchar(100),
   codigoMedico int NOT NULL,
   CONSTRAINT agendFk FOREIGN KEY (codigoMedico)
           REFERENCES medico (codigo)
           ON UPDATE CASCADE
           ON DELETE CASCADE
) ENGINE=InnoDB;