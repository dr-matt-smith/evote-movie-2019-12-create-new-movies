
-- create the table
create table if not exists movie (
    id integer primary key AUTO_INCREMENT,
    title text,
    price float
);

-- insert some data
insert into movie values (1, 'jaws',9.99);
insert into movie values (2, 'jaws2',4);
insert into movie values (3, 'mama mia',9.99);
insert into movie values (4, 'forget Paris',8);