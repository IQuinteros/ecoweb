CREATE DATABASE ecomercio;
USE ecomercio;
CREATE TABLE search (
    id int NOT null,
    search_text varchar(255) NOT null,
    search_date timestamp not null,
    user_id int,
    PRIMARY KEY (id)
);

CREATE TABLE `user` (
    id int NOT null,
    creation_date timestamp not null,
    profile_id int not null,
    PRIMARY KEY (id)
);

CREATE TABLE `profile` (
    id int NOT null,
    name varchar(100) NOT null,
    last_name varchar(100) not null,
    email varchar(50) not null,
    contact_number integer not null,
    birthday timestamp not null,
    terms_checked char(1) not null,
    location varchar(200) not null,
    passwords varchar(255) not null,
    rut int not null,
    rut_cd char not null,
    creation_date timestamp not null,
    last_update_date timestamp not null,
    district_id integer,
    PRIMARY KEY (id)
  );
  
CREATE TABLE history(
    id int not null,
    creation_date timestamp not null,
    article_id int,
    user_id int,
    PRIMARY KEY (id)
);

CREATE TABLE history_detail(
    id int not null,
    creation_date timestamp not null,
    deleted char(1) not null,
    history_id int not null,
    PRIMARY KEY (id),
    UNIQUE KEY(history_id)
);

CREATE TABLE opinion (
    id int not null,
    rating int not null,
    title varchar(50) not null,
    content varchar(250) not null,
    creation_date timestamp not null,
    article_id int,
    profile_id int,
    PRIMARY KEY (id)
);

CREATE TABLE question(
    id int not null,
    question varchar(150) not null,
    creation_date timestamp not null,
    profile_id int,
    article_id int,
    answer_id int not null,
    PRIMARY KEY (id)
);

CREATE TABLE answer(
    id int not null,
    answer varchar(255) not null,
    creation_date timestamp not null,
    PRIMARY KEY (id)
);

CREATE TABLE favorite(
    id int not null,
    creation_date timestamp not null,
    profile_id int,
    article_id int,
    PRIMARY KEY(id)
);

CREATE TABLE district(
    id int not null,
    name varchar(30),
    PRIMARY KEY (id)
);

CREATE TABLE message(
    id int not null,
    message varchar(255) not null,
    creation_date timestamp not null,
    profile_id int,
    store_id int,
    chat_id int,
    PRIMARY KEY (id)
);

CREATE TABLE chat(
    id int not null,
    creation_date timestamp not null,
    closed char(1),
    PRIMARY KEY (id)
);

CREATE TABLE purchase(
    id int not null,
    total int not null,
    creation_date timestamp not null,
    profile_id int,
    info_purchase_id int,
    chat_id int,
    PRIMARY KEY (id)
);

CREATE TABLE article(
    id int not null,
    title varchar(150) not null,
    description text not null,
    price int not null,
    stock int not null,
    creation_date timestamp not null,
    lat_update_date timestamp not null,
    enabled char(1) not null,
    article_form_id int not null,
    category_id int,
    store_id int,
    PRIMARY KEY (id)
);

CREATE TABLE photo(
    id int not null,
    photo blob not null,
    article_id int not null,
    PRIMARY KEY (id)
);

CREATE TABLE category(
    id int not null,
    title varchar(50) not null,
    creation_date timestamp,
    PRIMARY KEY (id)
);

CREATE TABLE info_purchase(
    id int not null,
    names varchar(150) not null,
    location varchar(255) not null,
    contact_number int not null,
    purchase_id int not null,
    district varchar(30) not null,
    PRIMARY KEY (id)
);

CREATE TABLE store(
    id int not null,
    public_name varchar(100) not null,
    description text not null,
    email varchar(50) not null,
    contact_number int not null,
    location varchar (200) not null,
    passwords varchar(255) not null,
    rut int not null,
    rut_cd char not null,
    enabled char(1) not null,
    creation_date timestamp not null,
    last_update_date timestamp not null,
    district_id int,
    PRIMARY KEY (id)
);

CREATE TABLE article_form(
    id int not null,
    creation_date timestamp not null,
    last_update_date timestamp not null,
    article_id int not null,
    recycled_mats varchar(10) not null,
    recycled_mats_detail varchar(255),
    general_detail text,
    reuse_tips text,
    recycled_prod varchar(10) not null,
    recycled_prod_detail varchar(255),
    PRIMARY KEY (id)
);

CREATE TABLE article_purchase(
    id int not null,
    purchase_id int not null,
    article_id int not null,
    title varchar(50) not null,
    unit_price int not null,
    quantity int not null,
    PRIMARY KEY(id),
    UNIQUE KEY(purchase_id),
    UNIQUE KEY(article_id)
);

ALTER TABLE search
    ADD CONSTRAINT search_user_FK
    FOREIGN KEY(user_id) REFERENCES `user`(id)
;

ALTER TABLE `user`
    ADD CONSTRAINT user_profile_FK
    FOREIGN KEY(profile_id) REFERENCES `profile`(id)
;

ALTER TABLE `profile`
    ADD CONSTRAINT profile_district_FK
    FOREIGN KEY(district_id) REFERENCES district(id)
;

ALTER TABLE history
    ADD CONSTRAINT history_article_FK
    FOREIGN KEY(article_id) REFERENCES article(id),
    ADD CONSTRAINT history_user_FK
    FOREIGN KEY(user_id) REFERENCES `user`(id)
;

ALTER TABLE history_detail
    ADD CONSTRAINT historyDetail_history_FK
    FOREIGN KEY(history_id) REFERENCES history(id)
;

ALTER TABLE opinion
    ADD CONSTRAINT opinion_article_FK
    FOREIGN KEY(article_id) REFERENCES article(id),
    ADD CONSTRAINT opinion_profile_FK
    FOREIGN KEY(profile_id) REFERENCES `profile`(id)
;

ALTER TABLE question
    ADD CONSTRAINT question_profile_FK
    FOREIGN KEY(profile_id) REFERENCES `profile`(id),
    ADD CONSTRAINT question_article_FK
    FOREIGN KEY(article_id) REFERENCES article(id),
    ADD CONSTRAINT question_answer_FK
    FOREIGN KEY(answer_id) REFERENCES answer(id)
;

ALTER TABLE favorite
    ADD CONSTRAINT favorite_profile_FK
    FOREIGN KEY(profile_id) REFERENCES `profile`(id),
    ADD CONSTRAINT favorite_article_FK
    FOREIGN KEY(article_id) REFERENCES article(id)
;

ALTER TABLE message
    ADD CONSTRAINT message_profile_FK
    FOREIGN KEY(profile_id) REFERENCES `profile`(id),
    ADD CONSTRAINT message_store_FK
    FOREIGN KEY(store_id) REFERENCES store(id),
    ADD CONSTRAINT message_chat_FK
    FOREIGN KEY(chat_id) REFERENCES chat(id)
;

ALTER TABLE purchase
    ADD CONSTRAINT purchase_profile_FK
    FOREIGN KEY(profile_id) REFERENCES `profile`(id),
    ADD CONSTRAINT purchase_info_purchase_FK
    FOREIGN KEY(info_purchase_id) REFERENCES info_purchase(id),
    ADD CONSTRAINT purchase_chat_FK
    FOREIGN KEY(chat_id) REFERENCES chat(id)
;

ALTER TABLE article
    ADD CONSTRAINT article_article_form_FK
    FOREIGN KEY(article_form_id) REFERENCES article_form(id),
    ADD CONSTRAINT article_category_FK
    FOREIGN KEY(category_id) REFERENCES category(id),
    ADD CONSTRAINT article_store_FK
    FOREIGN KEY(store_id) REFERENCES store(id)
;

ALTER TABLE photo
    ADD CONSTRAINT photo_article_FK
    FOREIGN KEY(article_id) REFERENCES article(id)
;

ALTER TABLE info_purchase
    ADD CONSTRAINT info_purchase_purchase_FK
    FOREIGN KEY(purchase_id) REFERENCES purchase(id)
;

ALTER TABLE store
    ADD CONSTRAINT store_district_FK
    FOREIGN KEY(district_id) REFERENCES district(id)
;

ALTER TABLE article_form
    ADD CONSTRAINT article_form_article_FK
    FOREIGN KEY(article_id) REFERENCES article(id)
;

ALTER TABLE article_purchase
    ADD CONSTRAINT article_purchase_purchase_FK
    FOREIGN KEY(purchase_id) REFERENCES purchase(id),
    ADD CONSTRAINT article_purchase_article_FK
    FOREIGN KEY(article_id) REFERENCES article(id)
;

ALTER TABLE `user` ADD COLUMN lastConnectionDate datetime not null;

ALTER TABLE store ADD COLUMN photo_url varchar(255);

ALTER TABLE article ADD COLUMN past_price int;

CREATE USER 'users'@'localhost' IDENTIFIED BY 'hola';

CREATE USER 'shop'@'localhost' IDENTIFIED BY 'EzMoney';

CREATE USER 'registered'@'localhost' IDENTIFIED BY 'derroche';

GRANT USAGE ON *.* TO 'users'@'localhost';
GRANT USAGE ON *.* TO 'shop'@'localhost';
GRANT USAGE ON *.* TO 'registered'@'localhost';

GRANT UPDATE, INSERT ON TABLE `user` TO 'users'@'localhost';
GRANT INSERT ON TABLE `search` TO 'users'@'localhost';
GRANT SELECT ON TABLE `profile` TO 'users'@'localhost';
GRANT SELECT, INSERT ON TABLE `history` TO 'users'@'localhost';
GRANT SELECT, UPDATE, INSERT ON TABLE `history_detail` TO 'users'@'localhost';
GRANT SELECT ON TABLE `opinion` TO 'users'@'localhost';
GRANT SELECT ON TABLE `question` TO 'users'@'localhost';
GRANT SELECT ON TABLE `answer` TO 'users'@'localhost';
GRANT SELECT ON TABLE `district` TO 'users'@'localhost';
GRANT SELECT, UPDATE, DELETE, INSERT ON TABLE `user` TO 'users'@'localhost';
GRANT SELECT ON TABLE `article` TO 'users'@'localhost';
GRANT SELECT ON TABLE `photo` TO 'users'@'localhost';
GRANT SELECT ON TABLE `article_form` TO 'users'@'localhost';
GRANT SELECT ON TABLE `category` TO 'users'@'localhost';
GRANT SELECT ON TABLE `store` TO 'users'@'localhost';

GRANT SELECT ON TABLE `user` TO 'shop'@'localhost';
GRANT SELECT ON TABLE `search` TO 'shop'@'localhost';
GRANT SELECT ON TABLE `profile` TO 'shop'@'localhost';
GRANT SELECT ON TABLE `history` TO 'shop'@'localhost';
GRANT SELECT ON TABLE `history_detail` TO 'shop'@'localhost';
GRANT SELECT ON TABLE `opinion` TO 'shop'@'localhost';
GRANT SELECT ON TABLE `question` TO 'shop'@'localhost';
GRANT SELECT, UPDATE, DELETE, INSERT ON TABLE `answer` TO 'shop'@'localhost';
GRANT SELECT ON TABLE `favorite` TO 'shop'@'localhost';
GRANT SELECT ON TABLE `district` TO 'shop'@'localhost';
GRANT SELECT, INSERT, DELETE ON TABLE `message` TO 'shop'@'localhost';
GRANT SELECT, INSERT, UPDATE ON TABLE `chat` TO 'shop'@'localhost';
GRANT SELECT ON TABLE `purchase` TO 'shop'@'localhost';
GRANT SELECT ON TABLE `info_purchase` TO 'shop'@'localhost';
GRANT SELECT ON TABLE `article_purchase` TO 'shop'@'localhost';
GRANT SELECT, UPDATE, DELETE, INSERT ON TABLE `article` TO 'shop'@'localhost';
GRANT SELECT, UPDATE, DELETE, INSERT ON TABLE `photo` TO 'shop'@'localhost';
GRANT SELECT, UPDATE, DELETE, INSERT ON TABLE `article_form` TO 'shop'@'localhost';
GRANT SELECT ON TABLE `category` TO 'shop'@'localhost';
GRANT SELECT, UPDATE, DELETE, INSERT ON TABLE `store` TO 'shop'@'localhost';

GRANT SELECT, UPDATE, DELETE ON TABLE `user` TO 'registered'@'localhost';
GRANT INSERT ON TABLE `search` TO 'registered'@'localhost';
GRANT SELECT, UPDATE, DELETE, INSERT ON TABLE `profile` TO 'registered'@'localhost';
GRANT SELECT, INSERT ON TABLE `history` TO 'registered'@'localhost';
GRANT SELECT, INSERT, UPDATE ON TABLE `history_detail` TO 'registered'@'localhost';
GRANT SELECT, UPDATE, DELETE, INSERT ON TABLE `opinion` TO 'registered'@'localhost';
GRANT SELECT, UPDATE, DELETE, INSERT ON TABLE `question` TO 'registered'@'localhost';
GRANT SELECT ON TABLE `answer` TO 'registered'@'localhost';
GRANT SELECT, INSERT, DELETE ON TABLE `favorite` TO 'registered'@'localhost';
GRANT SELECT ON TABLE `district` TO 'registered'@'localhost';
GRANT SELECT, INSERT ON TABLE `message` TO 'registered'@'localhost';
GRANT SELECT, INSERT, UPDATE ON TABLE `chat` TO 'registered'@'localhost';
GRANT SELECT, INSERT ON TABLE `purchase` TO 'registered'@'localhost';
GRANT SELECT, INSERT ON TABLE `info_purchase` TO 'registered'@'localhost';
GRANT SELECT, INSERT ON TABLE `article_purchase` TO 'registered'@'localhost';
GRANT SELECT ON TABLE `article` TO 'registered'@'localhost';
GRANT SELECT ON TABLE `photo` TO 'registered'@'localhost';
GRANT SELECT ON TABLE `article_form` TO 'registered'@'localhost';
GRANT SELECT ON TABLE `category` TO 'registered'@'localhost';
GRANT SELECT ON TABLE `store` TO 'registered'@'localhost';