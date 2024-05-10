create schema db_site;
use db_site;

CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_type ENUM('adm', 'comun') NOT NULL DEFAULT 'comun'
);

create table post (
    id int primary key auto_increment,
    content text not null,
    user_id int not null,
    created_at timestamp default current_timestamp,
    foreign key (user_id) references user(id)
);


create table comment (
    id int primary key auto_increment,
    content text not null,
    user_id int not null,
    post_id int not null,
    created_at timestamp default current_timestamp,
    foreign key (user_id) references user(id),
    foreign key (post_id) references post(id)
);

