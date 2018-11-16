CREATE TABLE spot_items(id int AUTO_INCREMENT PRIMARY KEY, author varchar(240), name varchar(240), body varchar(1500), post_date datetime, img_path varchar(6000));
CREATE TABLE bookmark(id int AUTO_INCREMENT PRIMARY KEY, user varchar(240), item_id int);
CREATE TABLE follow(id int AUTO_INCREMENT PRIMARY KEY, follow varchar(240), follower varchar(240)); 
CREATE TABLE items_detail(id int AUTO_INCREMENT PRIMARY KEY, item_id int, name varchar(240), body varchar(1500), lat double, lng double, img_path varchar(6000));
CREATE TABLE user(id int AUTO_INCREMENT PRIMARY KEY, username varchar(240), password varchar(1000), body varchar(1500), img_path varchar(6000));
