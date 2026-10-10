create database eval04;

use eval04;

create table consolas (
    id_consola int primary key auto_increment,
    descripcion varchar(100)
);

create table videojuegos (
    id_videojuego int primary key auto_increment,
    nombre varchar(100),
    id_consola int,
    precio_venta double,
    stock int,
    foreign key(id_consola) references consolas(id_consola)
);

insert into consolas(descripcion) values
('PlayStation 4'), ('PlayStation 5'), ('Nintendo Switch'), ('Xbox360');

insert into videojuegos(nombre,id_consola,precio_venta,stock) values
('Dragon Ball Z Kakarot',1,89,15),
('Spider-Man Miles Morales',2,159,25),
('Minecraft',3,125,12),
('Horizon Zero Dawn',1,89,10),
('FC 24 PS5 EA Sports Futbol',2,259,20),
('Pokemon Violet',3,249,25),
('Far Cry',2,139.99,12),
('Horizon: Forbidden West',1,239.99,18),
('Sniper Ghost Warrior Contracts 2',4,165,8),
('Plants Vs Zombies Battle for Neighborville',4,115,7);
