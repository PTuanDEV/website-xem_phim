create database we18205;
-- 
use we18205;
-- 
CREATE TABLE product (
  id int NOT NULL auto_increment,
  ten_sp varchar(255) NOT NULL,
  gia int NOT NULL,
primary key(id)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- 
INSERT INTO product (ten_sp, gia) VALUES 
('Sản Phẩm 1', '100'),
('Sản Phẩm 2', '200'),
('Sản Phẩm 3', '300');
-- 
create table customer(
id int not null auto_increment,
ten varchar(50) not null,
tuoi int not null,
primary key(id)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- 
INSERT INTO customer (ten, tuoi) VALUES 
('Customer 1', '20'),
('Customer 2', '21'),
('Customer 3', '22');
-- 