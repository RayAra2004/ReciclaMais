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
    fk_endereco_id int not null unique,
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
    fk_usuario_instituicao_fk_usuario_id int unique,
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
    (6, 'Hospitalar'),
    (7, 'Madeira'),
    (8, 'Eletrônicos');

insert into coletado (id, descricao) values  (1, 'disponível'),
    (2, 'indisponível'),
    (3, 'em transação');

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

 

insert into tipo_logradouro (tipo_logradouro) values
('rua'),
('avenida');


insert into estado (estado) values
('ES');

insert into cidade (cidade) values
('Serra');


insert into bairro (bairro) values
('Morada de Lanjeiras'),
('Carapina');

insert into endereco (cep, fk_tipo_logradouro_id, logradouro, fk_estado_id, fk_cidade_id, fk_bairro_id, numero, longitude, latitude) values
(29166860, 1, 'Arpoador', 1, 1, 1, 525, -40.229002, -20.190996),
(29166850, 1, 'São Conrado', 1, 1, 1, 15, -40.227510, -20.192678), 
(29166824, 1, 'Ondina', 1, 1, 1, 14, -40.230726, -20.192008),
(29166870, 1, 'Minas Gerais', 1, 1, 1, 70, -40.233603, -20.195941), 
(29166820, 2, 'Copacabana', 1, 1, 1, 0, -40.236036, -20.194538),
(29166610, 1, 'dos Calafates', 1, 1, 1, 0, -40.216443, -20.200339),
(29166690, 1, 'dos Melros', 1, 1, 2, 109, -40.219430, -20.197814),
(29166660, 1, 'dos Tangarás', 1, 1, 2, 0, -40.218953, -20.199207),
(29166828, 2, 'Paulo Pereira Gomes', 1, 1, 1, 877, -40.226670, -20.199099),
(29166650, 1, 'dos Rouxinóis', 1, 1, 2, 0, -40.223882, -20.198601),
(29166680, 1, 'das Patativas', 1, 1, 2, 170, -40.220727, -20.199405),
(29166828, 1, 'das Graúnas', 1, 1, 1, 94, -40.219785, -20.200905),
(29166734, 1, 'das Jandaias', 1, 1, 1, 0, -40.222208, -20.194073),
(29166858, 2, 'Atlântica', 1, 1, 1, 0, -40.223781, -20.190152),
(29166821, 1, 'Ipanema', 1, 1, 1, 15, -40.230990, -20.191107);

insert into cadastro_ponto_coleta (nome, imagem, fk_endereco_id, fk_usuario_id) values
('Recicla Aqui', 'https://ecrie.com.br/sistema/conteudos/imagem/m_107_1_11_25032022212408.jpg', 1, 1),
('Ponto Limpo', 'https://pocosdecaldas.mg.gov.br/wp-content/uploads/2019/03/ponto-de-coleta-seletiva.jpg', 2, 2),
('Coleta Verde', 'https://ecrie.com.br/sistema/conteudos/imagem/g_107_0_12_25032022212408.jpg', 3, 3),
('SustentaAção', 'https://rioonwatch.org.br/wp-content/uploads/2018/07/PostoDeColetaSeletiva.jpg', 4, 4),
('Viva Limpo', 'https://soscasanova.files.wordpress.com/2012/06/expansaoreciclagem1.jpg', 5, 5),
('EcoBairro', 'https://mid.curitiba.pr.gov.br/2016/capa/00181500.jpg', 6, 6),
('Verde Vizinhança', 'https://media.gazetadopovo.com.br/2018/02/4cbfea70c600aec15d3ec18eb4e8b4f3-gpMedium.jpg', 7, 7),
('Ponto Eco', 'https://www.santoestevao.ba.gov.br/admin/noticias/5f32d915985f8.jpg', 8, 8),
('Limpeza Local', 'https://santarem.pa.gov.br/storage/posts/December2022/whatsapp-image-2022-12-15-at-125647-5WnE9y.jpg', 9, 9),
('Coleta Eficiente', 'https://web.arapiraca.al.gov.br/wp-content/uploads/2020/11/Pevs.jpg', 10, 10),
('Recicla já', 'https://tudorondonia.com/uploads/21-01-20-oo64363viwly1hn.jpg', 11, 11),
('Planeta Limpo', 'https://meioambiente.socorro.sp.gov.br/wp-content/uploads/2022/03/container-500x263.jpg', 12, 12),
('Semeia Verde', 'https://agenciaeconordeste.com.br/wp-content/uploads/2020/12/Eco-da-Gente.jpg', 13, 13),
('EcoAmigo', 'https://www.cogic.fiocruz.br/wp-content/uploads/2011/12/ecoponto.jpg', 14, 14),
('Reciclagem Certa', 'https://www.cogic.fiocruz.br/wp-content/uploads/2021/03/ecoponto.jpg', 15, 15);

insert recicla (fk_categoria_de_materiais_reciclados_id, fk_ponto_coleta_id) values
(5, 1),
(2, 1),
(7, 1),
(1,2),
(2,2),
(3,2),
(4,2),
(5,2),
(6,2),
(7,2),
(8,2),
(1,3),
(2,3),
(4,3),
(6,3),
(7,3),
(3,4),
(5,4),
(1,4),
(2,4),
(8,4),
(7,4),
(1,5),
(4,5),
(1,6),
(2,6),
(3,6),
(4,6),
(5,6),
(6,7),
(1,8),
(2,8),
(3,8),
(4,8),
(5,8),
(6,8),
(7,8),
(8,8),
(8,9),
(7,9),
(6,9),
(5,9),
(1,10),
(2,10),
(5,10),
(4,11),
(2,11),
(7,11),
(8,11),
(3,11),
(2,12),
(8,13),
(5,13),
(4,13),
(1,13),
(1,14),
(2,14),
(3,14),
(4,14),
(5,14),
(6,14),
(7,14),
(8,14),
(4,15),
(2,15),
(1,15),
(6,15);

insert into usuario_pessoa_fisica (data_nascimento, fk_usuario_id) values
('1990-04-15', 1),
('1985-09-22', 2),
('1978-12-05', 3),
('2002-07-10', 4),
('1965-03-18', 5),
('1972-11-30', 6),
('1988-06-14', 7),
('2005-01-25', 8),
('1960-08-07', 9),
('1995-02-20', 10),
('1976-10-03', 11),
('1983-04-28', 12),
('2008-11-12', 13),
('1955-07-19', 14),
('1968-12-31', 15),
('1992-05-08', 16),
('1970-01-15', 17),
('1980-09-27', 18),
('2000-03-04', 19),
('1963-06-22', 20),
('1998-12-09', 21),
('1974-04-16', 22),
('1987-10-01', 23),
('2003-02-14', 24),
('1958-08-25', 25),
('1969-11-08', 26),
('1982-03-24', 27),
('1993-09-11', 28),
('1967-05-30', 29),
('1979-01-06', 30),
('1996-06-17', 31),
('1950-11-23', 32),
('1962-02-07', 33),
('1989-07-15', 34),
('2006-01-28', 35),
('1971-08-10', 36),
('1984-04-23', 37),
('1991-10-18', 38),
('1977-02-02', 39),
('1953-05-12', 40);



insert into comentario (conteudo, nota, fk_usuario_pessoa_fisica_fk_usuario_id, fk_ponto_coleta_id) values
('Ótimo ponto de coleta, sempre facilitando a vida da comunidade.', 4, 1, 1), 
('Esse ponto de coleta é uma decepção, sempre desorganizado e sujo.', 2, 2, 2), 
('Facilita demais a nossa responsabilidade ambiental, esse ponto de coleta.', 5, 3, 3),
('Prático e eficiente, esse ponto de coleta é essencial para a cidade.', 3, 4, 4),
('Muito bom poder contar com um ponto de coleta tão bem localizado.', 3, 5, 5),
('Ineficiente e mal conservado, esse ponto de coleta deixa muito a desejar.', 2, 6, 6), 
('Não confio nesse ponto de coleta, parece mais um local de descarte irregular.', 1, 7, 7), 
('A preservação do meio ambiente começa por pequenas ações, como usar esse ponto de coleta.', 4, 8, 8),
('Péssima experiência ao utilizar esse ponto de coleta, falta manutenção e cuidado.', 1, 9, 9),
('Iniciativas como essa merecem nosso reconhecimento, um ótimo ponto de coleta.', 3, 10, 10),
('É triste ver como esse ponto de coleta não atende às necessidades da comunidade.', 2,11, 11),
('Um ponto estratégico para quem se preocupa com o futuro do planeta.', 5, 12, 12),
('Cada vez mais importante ter pontos como esse para cuidar do nosso meio ambiente.', 5, 13, 13),
('Esse ponto de coleta é um exemplo de como pequenas ações fazem grandes diferenças.', 4, 14, 14),
('Um ponto de coleta que mais atrapalha do que ajuda, totalmente desorganizado.', 2, 15, 15), 
('Esse ponto de coleta é um reflexo da falta de compromisso com o meio ambiente.', 2, 16, 1),
('Uma facilidade que faz toda a diferença na hora de descartar materiais.', 3, 17, 2),
('Esse ponto de coleta merece ser divulgado, um verdadeiro aliado da sustentabilidade.', 4, 18, 3),
('Agradecemos por ter um ponto tão bem estruturado na nossa comunidade.', 5, 19, 4),
('Sustentabilidade começa por atitudes simples, como utilizar esse ponto de coleta.', 5, 20, 5),
('Não recomendo esse ponto de coleta, é evidente a falta de cuidado com as instalações.', 1, 21, 6), 
('Uma verdadeira bagunça, esse ponto de coleta não merece a confiança da comunidade.', 1, 22, 7), 
('Fico mais tranquilo sabendo que posso contar com esse ponto para descartar corretamente.', 4, 23, 8),
('Esse ponto de coleta é um investimento no futuro do nosso planeta.', 5, 24, 9),
('Praticidade aliada à consciência ambiental, esse ponto de coleta é nota 10.', 5, 25, 10),
('Esperava mais desse ponto de coleta, mas só encontrei descaso e desorganização.', 2, 26, 11), 
('Incrível como um simples ponto de coleta pode fazer tanta diferença.', 5, 27, 12),
('Sempre que passo por aqui, sinto orgulho desse ponto de coleta.', 4, 28, 13),
('Esse ponto é uma prova de que podemos fazer a diferença no meio ambiente.', 3, 29, 14),
('Fácil acesso e compromisso com o meio ambiente, isso define esse ponto de coleta.', 3, 30, 15),
('Um ponto estratégico que facilita a prática da sustentabilidade.', 4, 31, 1),
('Ineficaz e sujo, esse ponto de coleta está longe de cumprir sua função adequadamente.', 1, 32, 2), 
('Esse ponto de coleta é um exemplo de como uma boa ideia pode ser mal executada.', 2, 33, 3),
('Agradecemos por ter um ponto de coleta tão bem mantido na nossa região.', 5, 34, 4),
('Esse ponto merece todo o reconhecimento por promover a responsabilidade ambiental.', 4, 35, 5),
('A simplicidade desse ponto de coleta esconde a grandeza da sua importância.', 4, 36, 6),
('Cada vez mais necessário ter pontos como esse para preservar o meio ambiente.', 3, 37, 7),
('Esse ponto de coleta é um aliado indispensável na luta pela sustentabilidade.', 3, 38, 8),
('Facilidade e consciência ambiental andam de mãos dadas nesse ponto de coleta.', 3, 39, 9),
('Falta de manutenção evidente, esse ponto de coleta não é confiável.', 2, 40, 10), 
('É revoltante ver como esse ponto de coleta é mal administrado, uma vergonha para a comunidade.', 2, 1, 11), 
('A comunidade agradece por ter um ponto de coleta tão bem cuidado.', 5, 2, 12),
('Esse ponto de coleta é uma inspiração para outras localidades.', 4, 3, 13),
('Prático, organizado e essencial para quem se preocupa com o planeta. Top!', 5, 4, 14),
('Um ponto que demonstra como é possível unir praticidade e sustentabilidade.', 3, 5, 15),
('Esse ponto de coleta é um exemplo de como pequenas atitudes fazem a diferença.', 5, 6, 1),
('A responsabilidade ambiental começa aqui, nesse ponto de coleta.', 4, 7, 2),
('Esse ponto é um investimento no bem-estar do nosso meio ambiente.', 3, 8, 3),
('Agradeço por ter um ponto de coleta tão acessível na nossa comunidade.', 4, 9, 4),
('Esse ponto de coleta é um passo importante para um futuro mais sustentável.', 3, 10, 5),
('Que bom poder contar com um ponto de coleta tão bem mantido.', 5, 11, 6),
('Esse ponto é um verdadeiro parceiro na preservação do meio ambiente.', 3, 12, 7),
('A cada descarte, contribuímos para um planeta mais saudável. Obrigado, ponto de coleta!', 3, 13, 8),
('Esse ponto é uma prova de que cuidar do meio ambiente pode ser simples e eficiente.', 3, 14, 9),
('Evitem esse ponto de coleta, pois é mais um problema do que uma solução ambiental.', 2, 15, 10),
('Esse ponto de coleta é um pesadelo para quem se preocupa com o meio ambiente, totalmente negligenciado.', 2, 16, 11), 
('Uma experiência terrível ao utilizar esse ponto de coleta, a falta de manutenção é evidente e preocupante.', 2, 17, 12), 
('Esse ponto de coleta é um símbolo da conscientização e compromisso com o futuro.', 3, 18, 13),
('Prático, funcional e essencial para uma comunidade comprometida com a sustentabilidade.', 5, 19, 14),
('Esse ponto de coleta é um exemplo de como podemos fazer escolhas conscientes no nosso dia a dia.', 4, 20, 15),
('Agradeço por ter um ponto de coleta tão bem mantido e acessível na nossa região.', 4, 21, 1),
('Esse ponto é um verdadeiro aliado na missão de preservar o meio ambiente para as futuras gerações.', 5, 22, 2),
('Parabéns pela iniciativa de proporcionar um ponto de coleta tão eficiente para a comunidade.', 3, 23, 3),
('Cada vez mais necessário ter pontos como esse para conscientizar e preservar.', 4, 24, 4),
('Esse ponto de coleta é um ponto de referência para quem se preocupa com o meio ambiente.', 3, 25, 5),
('Praticidade e consciência ambiental se encontram nesse ponto de coleta exemplar.', 3, 26, 6),
('A facilidade de descartar corretamente é um privilégio proporcionado por esse ponto de coleta.', 5, 27, 7),
('Esse ponto é um exemplo de como podemos integrar práticas sustentáveis no nosso cotidiano.', 5, 28, 8),
('Agradecemos por ter um ponto de coleta tão bem planejado e mantido na nossa cidade.', 3, 29, 9),
('Esse ponto de coleta é uma demonstração clara de como pequenas ações podem ter grandes impactos.', 4, 30, 10),
('Praticidade, sustentabilidade e compromisso ambiental, tudo reunido nesse ponto de coleta.', 3, 31, 11),
('Um ponto estratégico que contribui significativamente para a preservação do meio ambiente.', 5, 32, 12),
('Esse ponto de coleta é um verdadeiro parceiro na construção de um futuro mais sustentável.', 4, 33, 13),
('A comunidade se beneficia imensamente com a presença desse ponto de coleta tão bem estruturado.', 3, 34, 14),
('Parabéns pelo compromisso com a sustentabilidade! Esse ponto de coleta é fundamental para a nossa cidade.', 5, 35, 15);
