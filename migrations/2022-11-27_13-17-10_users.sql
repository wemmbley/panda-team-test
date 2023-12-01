create table if not exists users(
    id bigint unsigned auto_increment,
    email varchar(255),
    password varchar(255),
    token varchar(255),
    token_expires datetime,
    primary key (id)
)