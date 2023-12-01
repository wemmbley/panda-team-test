create table if not exists polls(
    id bigint unsigned auto_increment,
    user_id bigint unsigned,
    title varchar(255),
    status enum('draft', 'published'),
    primary key (id),
    foreign key (user_id) references users(id)
)