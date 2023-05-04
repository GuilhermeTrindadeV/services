DROP TABLE IF EXISTS 
    usuario, 
    tipo_usuario, 
    equipe, 
    musica, 
    culto, 
    tipo_culto, 
    bloqueio, 
    equipe_usuario, 
    culto_musica;
-- Tabela de Usuário --
CREATE TABLE usuario (
    id INT(1) AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(100) NOT NULL,
    apelido VARCHAR(100) NOT NULL,
    token VARCHAR(100),
    tip_usu_id INT(1) NOT NULL,
    data_c DATETIME NOT NULL,
    data_m DATETIME NOT NULL
);

-- Tabela de Tipo De Usuário --
CREATE TABLE tipo_usuario (
    tip_usu_id INT(1) AUTO_INCREMENT PRIMARY KEY,
    tip_nome VARCHAR(100) NOT NULL,
    tip_nome_plural VARCHAR(100) NOT NULL,
    tip_data_c DATETIME NOT NULL,
    tip_data_m DATETIME NOT NULL
);

-- Tabela de Equipe --
CREATE TABLE equipe (
    equi_id INT(1) AUTO_INCREMENT PRIMARY KEY,
    equi_nome VARCHAR(100) NOT NULL,
    equi_usu_criador INT(1) NOT NULL,
    equi_lider INT(1) NOT NULL,
    equi_data_c DATETIME NOT NULL,
    equi_data_m DATETIME NOT NULL
);

-- Tabela de Musica --
CREATE TABLE musica (
    mus_id INT(1) AUTO_INCREMENT PRIMARY KEY,
    mus_usu_criador INT(1) NOT NULL,
    mus_nome VARCHAR(100) NOT NULL,
    mus_bpm INT(1) NOT NULL,
    mus_tom VARCHAR(3) NOT NULL,
    mus_data_c DATETIME NOT NULL,
    mus_data_m DATETIME NOT NULL
);

-- Tabela do Culto --
CREATE TABLE culto (
    cult_id INT(1) AUTO_INCREMENT PRIMARY KEY,
    cult_usu_criador INT(1) NOT NULL,
    cult_nome VARCHAR(100) NOT NULL, 
    cult_tipo INT(1) NOT NULL,
    cult_data_inicio DATE NOT NULL,
    cult_hora_inicio TIME NOT NULL,
    cult_data_termino DATE NOT NULL,
    cult_hora_termino TIME NOT NULL,
    cult_data_c DATETIME NOT NULL,
    cult_data_m DATETIME NOT NULL
);

-- Tabela de Tipo Culto --
CREATE TABLE tipo_culto (
    tip_culto_id INT(1) AUTO_INCREMENT PRIMARY KEY,
    tip_culto_usuario_criador INT(1) NOT NULL,
    tip_culto_nome VARCHAR(100) NOT NULL,
    tip_culto_data_c DATETIME NOT NULL,
    tip_culto_data_m DATETIME NOT NULL
);

-- Tabela de Bloqueio --
CREATE TABLE bloqueio (
    blo_id INT(1) AUTO_INCREMENT PRIMARY KEY,
    blo_usu_id INT(1) NOT NULL,
    blo_data_inicio DATE NOT NULL,
    blo_data_termino DATE NOT NULL,
    blo_motivo VARCHAR(300),
    blo_data_c DATETIME NOT NULL,
    blo_data_m DATETIME NOT NULL
);

-- Tabela Associativa da Equipe e do Usuário --
CREATE TABLE equipe_usuario (
    eq_usu_id INT(1) AUTO_INCREMENT PRIMARY KEY,
    eq_usu_eq_id INT(1) NOT NULL,
    eq_usu_usu_id INT(1) NOT NULL
);

-- Tabela Associativa da Equipe e do Usuário --
CREATE TABLE culto_equipe (
    cult_eq_id INT(1) AUTO_INCREMENT PRIMARY KEY,
    cult_eq_cult_id INT(1) NOT NULL,
    cult_eq_eq_id INT(1) NOT NULL
);

CREATE TABLE culto_musica (
    cult_mus_id INT(1) AUTO_INCREMENT PRIMARY KEY,
    cult_id INT(1) NOT NULL,
    mus_id INT(1) NOT NULL
);