CREATE DATABASE frest;

use frest;

create table usuario (
id int auto_increment,
nome varchar(100) unique not null,
senha varchar(30) not null,
data_criacao timestamp default current_timestamp,
primary key(id)
);

create table texto (
id int auto_increment,
titulo varchar(50),
descricao varchar(300) not null,
data_criacao timestamp default current_timestamp,
id_digito int not null,
primary key (id),
foreign key (id_digito) references usuario(id)
);