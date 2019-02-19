create database vr_examination_storage;

CREATE USER 'vr_examiner'@'localhost' IDENTIFIED BY 'vr_examiner_pass';

GRANT ALL PRIVILEGES ON *.* TO 'vr_examiner'@'localhost' IDENTIFIED BY 'vr_examiner_pass';


create table movie1 (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    country TEXT NOT NULL,
    school TEXT NOT NULL,
    class TEXT NOT NULL,
    moderator_name TEXT NOT NULL,
    date DATE,
    gender TEXT NOT NULL,
    chose_to_continue_with TEXT NOT NULL,
    tough_that_chen_should TEXT NOT NULL
);

create table movie2 (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    country TEXT NOT NULL,
    school TEXT NOT NULL,
    class TEXT NOT NULL,
    moderator_name TEXT NOT NULL,
    date DATE,
    gender TEXT NOT NULL,
    what_id_daniel_going_through TEXT NOT NULL,
    did_the_friends_help_daniel TEXT NOT NULL
);


