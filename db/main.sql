DROP TABLE  user_app;
DROP TABLE  favorite;
DROP TABLE  graphics_card;
DROP TABLE  computer_case;
DROP TABLE  cooler;
DROP TABLE  memory;
DROP TABLE  motherboard;
DROP TABLE  power_supply_unit;
DROP TABLE  processor;
DROP TABLE  storage;

CREATE TABLE public.user_app (id SERIAL NOT NULL PRIMARY KEY,username VARCHAR(100) NOT NULL UNIQUE,password VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL);
CREATE TABLE public.favorite (id SERIAL NOT NULL PRIMARY KEY,user_id INT NOT NULL REFERENCES user_app(id), part_id INT NOT NULL, table_name VARCHAR(100) NOT NULL);
CREATE TABLE public.graphics_card (id SERIAL NOT NULL PRIMARY KEY,part_name VARCHAR(100) NOT NULL,price REAL,series VARCHAR(100),memory VARCHAR(100),chipset VARCHAR(100),coreClock REAL);
CREATE TABLE public.computer_case (id SERIAL NOT NULL PRIMARY KEY,part_name VARCHAR(100) NOT NULL,price REAL,case_type VARCHAR(100),five_and_a_quarter_inch_bays INT,three_and_a_quarter_inch_bays INT,powerSupply BOOLEAN);
CREATE TABLE public.cooler (id SERIAL NOT NULL PRIMARY KEY,part_name VARCHAR(100) NOT NULL,price REAL,noise REAL, rpm INT);
CREATE TABLE public.memory (id SERIAL NOT NULL PRIMARY KEY,part_name VARCHAR(100) NOT NULL,price REAL,speed VARCHAR(100),part_type VARCHAR(100),cas INT,modules VARCHAR(100),size VARCHAR(100),pricePerGB REAL);
CREATE TABLE public.motherboard (id SERIAL NOT NULL PRIMARY KEY,part_name VARCHAR(100) NOT NULL,price REAL,socket VARCHAR(100),formFactor VARCHAR(100),ramSlots INT,maxRAM INT);
CREATE TABLE public.power_supply_unit (id SERIAL NOT NULL PRIMARY KEY,part_name VARCHAR(100) NOT NULL,price REAL,series VARCHAR(100),form VARCHAR(100),efficiency VARCHAR(100),watts INT,modular VARCHAR(100));
CREATE TABLE public.processor (id SERIAL NOT NULL PRIMARY KEY,part_name VARCHAR(100) NOT NULL,price REAL,speed REAL,tdp INT,cores INT);
CREATE TABLE public.storage (id SERIAL NOT NULL PRIMARY KEY,part_name VARCHAR(100) NOT NULL,price REAL,series VARCHAR(100),form VARCHAR(100),part_type VARCHAR(100),capacity VARCHAR(100),cache VARCHAR(100),pricePerGB REAL);

INSERT INTO processor(part_name,price,speed,tdp,cores) VALUES ('Intel Core i7-8700K','347.99',3.7,95,6);