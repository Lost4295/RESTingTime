CREATE TABLE users (
    id serial PRIMARY KEY,
    create_date timestamp,
    username varchar(100) UNIQUE NOT NULL,
    password varchar(200),
    email varchar(100) UNIQUE NOT NULL,
    first_name varchar(100),
    last_name varchar(100),
    status integer NOT NULL DEFAULT 1
);

CREATE TABLE appartement (
    id serial PRIMARY KEY,
    create_date timestamp,
    superficie integer NOT NULL,
    max_pers integer NOT NULL,
    address text NOT NULL,
    available boolean NOT NULL DEFAULT true,
    price float NOT NULL,
    creator integer REFERENCES users(id)
);

CREATE TABLE reservation (
    id serial PRIMARY KEY,
    create_date timestamp,
    start_date date NOT NULL,
    end_date date NOT NULL,
    user_id integer REFERENCES users(id),
    appartement_id integer REFERENCES appartement(id),
    price float NOT NULL
);

INSERT INTO users (create_date, username, password, email, first_name, last_name, status) VALUES (NOW(), 'admin', 'admin', 'admin@admin', 'admin', 'admin', 8);
INSERT INTO users (create_date, username, password, email, first_name, last_name, status) VALUES (NOW(), 'loc', 'loc', 'loc@loc', 'loc', 'loc', 2);
INSERT INTO users (create_date, username, password, email, first_name, last_name, status) VALUES (NOW(), 'user', 'user', 'user@user', 'user', 'user', 1);
INSERT INTO appartement (create_date, superficie, max_pers, address, available, price, creator) VALUES (NOW(), 100, 4, 'rue de la paix', true, 100, 1);
INSERT INTO appartement (create_date, superficie, max_pers, address, available, price, creator) VALUES (NOW(), 200, 6, 'rue de la guerre', true, 200, 1);
INSERT INTO reservation (create_date, start_date, end_date, user_id, appartement_id, price) VALUES (NOW(), '2020-01-01', '2020-01-10', 2, 1, 100);
INSERT INTO reservation (create_date, start_date, end_date, user_id, appartement_id, price) VALUES (NOW(), '2020-01-01', '2020-01-10', 2, 2, 200);
