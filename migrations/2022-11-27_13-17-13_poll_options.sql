create table if not exists poll_options(
     id bigint unsigned auto_increment,
     poll_id bigint unsigned,
     name varchar(255),
     primary key (id),
     foreign key (poll_id) references polls(id)
)