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

insert into estado (id, estado) values
(1, 'ES')

insert into usuario (login, senha, nome, telefone, fk_tipo_usuario_id) values
('user1@gmail.com', '$2y$10$BLmNk3RiPVrt9P161QBMfOfyl3VsQUK2HAhTfSVIBkB/Xf31yz.O6', 'Ana', 11111111111, 2),
('user2@gmail.com', '$2y$10$bPEbksfNU10A3EJna4lgvu4ldUl/0ZzeA9c2ejuaF8Kobqp1bFWOO', 'Bernardo', 22222222222, 2),
('user3@gmail.com', '$2y$10$.7ZML8EY0xSnMKwMvL.Hd.GvGkruBZPKgv85Sp9mklnUUZh9MSvCG', 'Carlitos', 33333333333, 2),
('user4@gmail.com', '$2y$10$4KOKO4PD2LUpYOo0o8IFbu6/IkQXMD/OWcpN8Ptyfrm5tWJlj62pm', 'Daniel', 44444444444, 2),
('user5@gmail.com', '$2y$10$kjibJDuQD/zxG5PkrkbnpuopQuxh6pyW5sxqXwRJckEi2Zu8oiYyC', 'Eduardo', 55555555555, 2),
('user6@gmail.com', '$2y$10$t7HqNotEwsT6PQYlr19OAe7AlIgXo6n/OxrLrCU7pzE66wl/KTWL2', 'Fátima', 66666666666, 2),
('user7@gmail.com', '$2y$10$bm/XbAUs2UA2RdeCj8Hqh.fYJskTkCpeFGYesbN7vFR6Ltmb76xbG', 'Gabriel', 77777777777, 2),
('user8@gmail.com', '$2y$10$036xZqkhH1erdFa1VFMlV.IdUbMiv4iZ1iLoOw9jsgS/K8kD9OMuq', 'Hugo', 88888888888, 2),
('user9@gmail.com', '$2y$10$/xsqYd20VlVSOjPlyz4yAOHowc26qsymh0cwt6J1e9TU8YoAL3UUm', 'Ingrid', 99999999999, 2),
('user10@gmail.com', '$2y$10$F36RTX.DoOJDagFYz1/0Fe0hzQioOWJOKRZFolfJ8nxK1nPZ0PMU.', 'Julia', 12121212121, 2),
('user11@gmail.com', '$2y$10$ScRyYTP3LcsNMtL8cmbzrewiOT7MRLvYn466Ubyn2dFK5v0F1d5ai', 'Katia', 13131313131, 2),
('user12@gmail.com', '$2y$10$qLdbd0S2zC88JQPThlGbA.bZyoPfMZJ9hhJXlaDV.11VWIu.YtkE2', 'Luiz', 14141414141, 2),
('user13@gmail.com', '$2y$10$QmjxU8zT.DsOHSOIgc0NteHgHud34ZglvPbaChOxXetCssxVl5zxC', 'Marcelo', 15151515151, 2),
('user14@gmail.com', '$2y$10$UrdyV18xdQAob9LXpG0f1Oujmk2wDbK/.qAxyYeA84Di.V7yJRXDq', 'Natan', 16161616161, 2),
('user15@gmail.com', '$2y$10$02HuLXSGpxoXro32FR2DpOflhde2wUaUIJrnz5pSWT68qKWt3zHPu', 'Otavio', 17171717171, 2),
('user16@gmail.com', '$2y$10$GtbnX6HPPLeBXr797tNAtu6GVu3wYrPRdzhAD92yudl9PCeSHxRpq', 'Patricia', 18181818181, 2),
('user17@gmail.com', '$2y$10$w65KdvI3OnnmGOCgTem02.nnppQrNyCIqXxokom8BL3gFeHXZJ916', 'Quemuel', 19191919191, 2),
('user18@gmail.com', '$2y$10$LH8Jp/mG4d/JvvKdRu0lJuuCpCb/H50v.Wh.Oc45g/E7oH8v/tctO', 'Ricardo', 10101010101, 2),
('user19@gmail.com', '$2y$10$Y2TLHS0lz09msTUFonuQEuZUsayjlsxl5CJnxVYQAhgKqvv4I6bSy', 'Sandro', 20202020202, 2),
('user20@gmail.com', '$2y$10$amo2b86JuYUcSC0gbkdSDeE1kirY6aq8T3Gy1eVV188QJ/6Z5xx2a', 'Tatiana', 30303030303, 2),
('user21@gmail.com', '$2y$10$fyfe9lhBUoQhuv0aFj/fn.MqYYLK5Xa51vYJgriZXUByoIcevI0eu', 'Usislei', 40404040404, 2),
('user22@gmail.com', '$2y$10$mkiUYEk46zIYh8vDaEcgiuYfBoIm8GbY.zDmsWQOQPVntiYcbnUF2', 'Vania', 50505050505, 2),
('user23@gmail.com', '$2y$10$BHaF16LLiYPriif1dnvxI.cPBr.1mgbcgvxCmBAluBUxyj8s.2AhG', 'Wanda', 60606060606, 2),
('user24@gmail.com', '$2y$10$98wbYr/rtFc57G.d4oqYxeeRaUfyf0ZxiyMJF2jh3WMr.wL3h9uDW', 'Xavi', 70707070707, 2),
('user25@gmail.com', '$2y$10$s08LPyos7A9wQOxh5tNKKOudL3sSTHC8QymT3eZzQx9QrMzmvn9gS', 'Yuri', 80808080808, 2),
('user26@gmail.com', '$2y$10$iAZ4NrfvB0SEBOVEf.tbvOwMfwfzU90xPQwESPZRnnN66.me/rA1W', 'Zata', 90909090909, 2),
('user27@gmail.com', '$2y$10$Q.njpWVTGEMxIj0F4rXY8.CUESVYtF3e9BAXKA3FtxgsHO/NF85k.', 'Amanda', 91919191919, 2),
('user28@gmail.com', '$2y$10$LbuSdwj0KPeQs2ToybzH8OAtijZhz1hI4HhO9e6FMtJOg8/4KNrbq', 'Bruno', 92929292929, 2),
('user29@gmail.com', '$2y$10$Np49byqDNQ5uvlsOkWI8QO1fLtp1BsTYZLjzB5VvPbYSOb/I/s1ei', 'Carina', 93939393939, 2),
('user30@gmail.com', '$2y$10$CmcpzeVP59lnsGo2NqoHY.4un9HlvraXqVZjrg0Yja331FPf47Jcq', 'Davi', 94949494949, 2),
('user31@gmail.com', '$2y$10$NJ/PcKX9rPNzFd8Gl61C4eph3NjkVOeDxRy2aZS72y.qCds1.TW76', 'Erika', 95959595959, 2),
('user32@gmail.com', '$2y$10$czKsFfMO65rtkGj83PWNG.sTEYB0pX5HzAYnSnqIfDULag2ZXrnD6', 'Fernando', 96969696969, 2),
('user33@gmail.com', '$2y$10$ea/GIQcSu05uBgfCGA24Ee.nXTfZRP1LLfIFsdS82eat3SimxWsOe', 'Gustavo', 97979797979, 2),
('user34@gmail.com', '$2y$10$TD/iMteQlMYomoJqBxlmn.wEOo9cEDltKDGRmp4XU0XAY8C7iPGN2', 'Hata', 98989898989, 2),
('user35@gmail.com', '$2y$10$62dOjMm4yVwHp13PJW0xvOGP6XxunEcEFa7Ej6743MgK6CtiSPqYS', 'Ivone', 11991199119, 2),
('user36@gmail.com', '$2y$10$oLbHtkzrHnljsOF4dHcCXO.z3OnOaEjmTVwvTOcKU08BCMP94Dj6e', 'Jussara', 22992299229, 2),
('user37@gmail.com', '$2y$10$SDPFTDW26uPC01BK.WF/m.tvQOUfgwRp7zwgwEhHJ6Ua8JctaMoVi', 'Karen', 33993399339, 2),
('user38@gmail.com', '$2y$10$/wIkUAePIaTfGAXL5/igOOoK/V.e77yN1DTbjtrEdD5IcVmiq5HMm', 'Luiza', 44994499449, 2),
('user39@gmail.com', '$2y$10$/Aomuz/w1Bi/R6bLNRhWJedsmdWGZyEp6clUXfPNJItq/iHpkM7FC', 'Marta', 55995599559, 2),
('user40@gmail.com', '$2y$10$xYQGuztLMFf0CBi0gVg4EeEl8yq8mbP4UhXRmMsrtDRkM04ZQELR2', 'Nauvia', 66996699669, 2);

insert into endereco (fk_tipo_logradouro_id, logradouro, fk_estado_id, fk_cidade_id, fk_bairro_id, numero, complemento, longitude, latitude) values
() 





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



