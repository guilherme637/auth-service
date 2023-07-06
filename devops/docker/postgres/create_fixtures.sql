CREATE TABLE IF NOT EXISTS client_scope
(
    client_id VARCHAR     NOT NULL,
    ds_scope  VARCHAR(15) NOT NULL
);


CREATE TABLE IF NOT EXISTS redirect_uri
(
    client_id    VARCHAR     NOT NULL,
    uri_redirect VARCHAR(15) NOT NULL
);

CREATE TABLE IF NOT EXISTS client
(
    client_id                  VARCHAR PRIMARY KEY NOT NULL UNIQUE,
    client_secret              VARCHAR             NOT NULL,
    token_endpoint_auth_method VARCHAR     DEFAULT 'client_secret_post',
    redirect_uri               VARCHAR(225)        NOT NULL,
    client_name                VARCHAR(120)        NOT NULL,
    grant_type                 VARCHAR(30) DEFAULT 'authorization_code',
    client_id_issued_at        timestamp   default now(),
    client_secret_expires_at   timestamp           NOT NULL
);

CREATE TABLE IF NOT EXISTS users
(
    nu_seq_users serial PRIMARY KEY,
    username     VARCHAR(25) NOT NULL UNIQUE UNIQUE,
    email        VARCHAR(70) NOT NULL UNIQUE UNIQUE,
    password     VARCHAR     NOT NULL
);

CREATE TABLE IF NOT EXISTS users_scope
(
    nu_seq_users_scope serial PRIMARY KEY,
    nu_seq_users       INTEGER     NOT NULL,
    ds_scope           VARCHAR(15) NOT NULL,

    CONSTRAINT fk_nu_seq_users FOREIGN KEY (nu_seq_users) REFERENCES users (nu_seq_users)
);

alter table users
    add nu_seq_users_scope integer not null default 0,
    add constraint fk_nu_seq_users_scope
        foreign key (nu_seq_users_scope) references users_scope (nu_seq_users_scope);


-- insert into authorization_serve values (
--     DEFAULT,
--     '459580faac276b13c9ddb60d480c34f795aa5dabb8df4655e5a0d793d0b41c9a',
--     '1614aed6e5adb9f44d8c56370a9f77cb0940c221c4e14cdc86444576dae7af9d',
--     'http://myfinance.com.br:3030/check',
--     2
-- );
-- insert into scopes values (DEFAULT, 'create');
-- insert into scopes values (DEFAULT, 'read');
-- insert into scopes values (DEFAULT, 'update');
-- insert into scopes values (DEFAULT, 'delete');
