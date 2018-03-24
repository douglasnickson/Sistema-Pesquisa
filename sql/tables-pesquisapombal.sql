use pesquisapombal;

create table tb_pergunta (
	id int auto_increment not null primary key,
	titulo varchar (100)
);

create table tb_alternativa (
	id int auto_increment not null primary key,
	titulo varchar (100),
	id_pergunta int not null,
	foreign key (id_pergunta) references tb_pergunta(id)
);

create table tb_usuario (
	cpf varchar(14) not null primary key,
	idade int not null,
	sexo enum ('M', 'F') not null
);

create table tb_resposta (
	cpf_usuario varchar(14) not null,
    id_pergunta int not null,
    id_resposta int not null,
    foreign key (cpf_usuario) references tb_usuario(cpf),
    foreign key (id_pergunta) references tb_pergunta(id),
    foreign key (id_resposta) references tb_alternativa(id)
);
