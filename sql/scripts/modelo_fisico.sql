drop table if exists usuario, usuario_instituicao, usuario_pessoa_fisica, categoria_de_materiais_reciclados, tipo_usuario, endereco, bairro, cidade, estado, cadastro_ponto_coleta, comentario, recicla, valida, tipo_assinatura, material_reciclavel, pertence, coletado, tipo_logradouro;

create table usuario (
    login varchar(90) not null unique,
    senha text not null,
    id serial primary key,
    nome varchar(50) not null,
    telefone bigint not null,
    fk_tipo_usuario_id int not null
);

create table usuario_instituicao (
    cnpj varchar(18) not null unique,
    logo text,
    fk_usuario_id int primary key,
    fk_endereco_id int not null,
    fk_tipo_assinatura_id int not null,
    data_cadastro date not null default(now()),
    data_expiracao date not null default(now())
);

create table usuario_pessoa_fisica (
    data_nascimento date not null,
    fk_usuario_id int primary key
);

create table categoria_de_materiais_reciclados (
    id serial primary key,
    descricao varchar(20) not null unique
);

create table tipo_usuario (
    id serial primary key,
    descricao varchar(20) not null unique
);

create table endereco (
    cep bigint not null,
    fk_tipo_logradouro_id int not null,
    logradouro varchar(50) not null,
    fk_estado_id int not null,
    fk_cidade_id int not null,
    fk_bairro_id int not null,
    numero int not null,
    complemento text,
    id serial primary key,
    longitude float not null,
    latitude float not null
);

create table cadastro_ponto_coleta (
    nome varchar(30) not null,
    id serial primary key,
    imagem text,
    fk_usuario_instituicao_fk_usuario_id int,
    fk_endereco_id int not null,
    fk_usuario_id int not null,
    data_cadastro timestamp default(now())
);

create table comentario (
    conteudo varchar(500) not null,
    id serial primary key,
    data_postagem timestamp not null default(now()),
    nota int not null,
    fk_usuario_pessoa_fisica_fk_usuario_id int not null,
    fk_ponto_coleta_id int not null
);

create table material_reciclavel (
    peso_estimado varchar(30) not null,
    id serial primary key,
    descricao varchar(300) not null,
    fk_usuario_pessoa_fisica_fk_usuario_id int not null,
    fk_usuario_instituicao_fk_usuario_id int not null,
    latitude bigint not null,
    longitude bigint not null,
    fk_coletado_id int not null
);

create table tipo_assinatura (
    id serial primary key,
    nome varchar(20) not null unique,
    descricao varchar(500) not null,
    valor int not null
);

create table tipo_logradouro (
    id serial not null primary key,
    tipo_logradouro varchar(30) not null unique
);

create table estado (
    id serial not null primary key,
    estado varchar(2) not null unique
);

create table cidade (
    id serial not null primary key,
    cidade varchar(30) not null unique
);

create table bairro (
    id serial not null primary key,
    bairro varchar(30) not null unique
);

create table recicla (
    fk_categoria_de_materiais_reciclados_id int not null,
    fk_ponto_coleta_id int not null
);

create table valida (
    fk_usuario_id int not null,
    fk_cadastro_ponto_coleta_id int not null,
    data_validacao timestamp default(now()),
    resposta boolean not null
);

create table pertence (
    fk_categoria_de_materiais_reciclados_id int not null,
    fk_material_reciclavel_id int not null
);

create table coletado (
    id serial primary key,
    descricao varchar(30) not null
);

alter table usuario add constraint fk_usuario_2
    foreign key (fk_tipo_usuario_id)
    references tipo_usuario (id)
    on delete cascade;

alter table usuario_instituicao add constraint fk_usuario_instituicao_2
    foreign key (fk_usuario_id)
    references usuario (id)
    on delete cascade;

alter table usuario_instituicao add constraint fk_usuario_instituicao_3
    foreign key (fk_endereco_id)
    references endereco (id)
    on delete cascade;

alter table usuario_instituicao add constraint fk_usuario_instituicao_4
    foreign key (fk_tipo_assinatura_id)
    references tipo_assinatura (id)
    on delete set null;

alter table usuario_pessoa_fisica add constraint fk_usuario_pessoa_fisica_2
    foreign key (fk_usuario_id)
    references usuario (id)
    on delete cascade;

alter table endereco add constraint fk_endereco_2
    foreign key (fk_tipo_logradouro_id)
    references tipo_logradouro (id)
    on delete no action;

alter table endereco add constraint fk_endereco_3
    foreign key (fk_estado_id)
    references estado (id)
    on delete no action;

alter table endereco add constraint fk_endereco_4
    foreign key (fk_cidade_id)
    references cidade (id)
    on delete no action;

alter table endereco add constraint fk_endereco_5
    foreign key (fk_bairro_id)
    references bairro (id)
    on delete no action;

alter table cadastro_ponto_coleta add constraint fk_cadastro_ponto_coleta_2
    foreign key (fk_usuario_instituicao_fk_usuario_id)
    references usuario_instituicao (fk_usuario_id);

alter table cadastro_ponto_coleta add constraint fk_cadastro_ponto_coleta_3
    foreign key (fk_endereco_id)
    references endereco (id);

alter table cadastro_ponto_coleta add constraint fk_cadastro_ponto_coleta_4
    foreign key (fk_usuario_id)
    references usuario (id);

alter table comentario add constraint fk_comentarios_2
    foreign key (fk_usuario_pessoa_fisica_fk_usuario_id)
    references usuario_pessoa_fisica (fk_usuario_id)
    on delete cascade;

alter table comentario add constraint fk_comentarios_3
    foreign key (fk_ponto_coleta_id)
    references cadastro_ponto_coleta(id);

alter table material_reciclavel add constraint fk_material_reciclavel_2
    foreign key (fk_usuario_pessoa_fisica_fk_usuario_id)
    references usuario_pessoa_fisica (fk_usuario_id)
    on delete cascade;

alter table material_reciclavel add constraint fk_material_reciclavel_3
    foreign key (fk_usuario_instituicao_fk_usuario_id)
    references usuario_instituicao (fk_usuario_id)
    on delete cascade;

alter table recicla add constraint fk_recicla_1
    foreign key (fk_categoria_de_materiais_reciclados_id)
    references categoria_de_materiais_reciclados (id)
    on delete restrict;

alter table recicla add constraint fk_recicla_2
    foreign key (fk_ponto_coleta_id)
    references cadastro_ponto_coleta(id);

alter table valida add constraint fk_valida_1
    foreign key (fk_usuario_id)
    references usuario (id)
    on delete set null;

alter table pertence add constraint fk_pertence_1
    foreign key (fk_categoria_de_materiais_reciclados_id)
    references categoria_de_materiais_reciclados (id)
    on delete restrict;

alter table pertence add constraint fk_pertence_2
    foreign key (fk_material_reciclavel_id)
    references material_reciclavel (id)
    on delete set null;

alter table material_reciclavel add constraint fk_material_reciclavel_5
    foreign key (fk_coletado_id)
    references coletado (id);




/* Inserção de dados */

insert into tipo_usuario (id, descricao) values 
    (1, 'Administrador'),
	(2, 'Pessoa Física'),
	(3, 'Instituição');


insert into tipo_assinatura(id, nome, descricao, valor) values  
    (1, 'GRATUITO', 'SEM BENEFÍCIOS', 0),
    (2, 'PLATINUM', 'RELATÓRIO GERAL SOBRE OS MATERIAIS MAIS PUBLICADOS. RELATÓRIO GERAL SOBRE OS BAIRROS COM MAIS MATERIAIS PUBLICADOS. RELATÓRIO GERAL SOBRE OS BAIRROS COM MAIS PONTOS DE COLETA. RELATÓRIO GERAL SOBRE OS TIPOS DE MATERIAIS RECICLADOS EM CADA BAIRRO. RELATÓRIO GERAL SOBRE OS LOCAIS COM MAIS USUÁRIOS. DESTAQUE EM NOSSA PÁGINA PRINCIPAL.', 119.9);

insert into categoria_de_materiais_reciclados (id, descricao) values 
    (1, 'Plástico'),
    (2, 'Papel'),
    (3, 'Vidro'),
    (4, 'Metal'),
    (5, 'Orgânico'),
    (6, 'Borracha'),
    (7, 'Madeira'),
    (8, 'Eletrônicos');

insert into coletado (id, descricao) values  (1, 'disponível'),
    (2, 'indisponível'),
    (3, 'em transação');