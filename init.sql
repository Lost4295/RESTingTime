CREATE TABLE user (
    id serial PRIMARY KEY,
    create_date timestamp,
    username varchar(100) UNIQUE NOT NULL,
    password varchar(200),
    email varchar(100) UNIQUE NOT NULL,
    first_name varchar(100),
    last_name varchar(100),
    status integer NOT NULL DEFAULT 1,
);

CREATE TABLE appartement (
    id serial PRIMARY KEY,
    create_date timestamp,
    superficie integer NOT NULL,
    max_pers integer NOT NULL,
    address text UNIQUE NOT NULL,
    available boolean NOT NULL DEFAULT 1,
    price float NOT NULL,
);

CREATE TABLE reservation (
    id serial PRIMARY KEY,
    create_date timestamp,
    start_date date NOT NULL,
    end_date date NOT NULL,
    user_id integer REFERENCES user(id),
    appartement_id integer REFERENCES appartement(id),
    price float NOT NULL,
);