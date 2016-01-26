CREATE TABLE usuario (
	id INTEGER PRIMARY KEY,
	login VARCHAR(255) UNIQUE NOT NULL,
	senha VARCHAR(32) NOT NULL,
	criadoEm DATE NOT NULL,
	atualizadoEm DATE,
	excluido INTEGER DEFAULT '0'
);

CREATE TABLE acessoToken (
	id INTEGER PRIMARY KEY,
	usuarioId INTEGER NOT NULL,
	tokenAcesso VARCHAR(32) UNIQUE NOT NULL,
	dataHoraInicio DATE NOT NULL,
	dataHoraFim DATE NOT NULL,
	criadoEm DATE NOT NULL,
	atualizadoEm DATE,
	excluido INTEGER DEFAULT '0',
	FOREIGN KEY(usuarioId) REFERENCES usuario(id)
);
