create table if not exists poll_votes(
    id bigint unsigned auto_increment,
    option_id bigint unsigned,
    votes int,
    primary key (id),
    foreign key (option_id) references poll_options(id)
)