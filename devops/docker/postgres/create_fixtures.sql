CREATE TABLE IF NOT EXISTS client_scope
(
    nu_seq_client_scope serial PRIMARY KEY,
    ds_scope            VARCHAR(15) NOT NULL
);

CREATE TABLE IF NOT EXISTS redirect_uri
(
    nu_seq_redirect_uri serial PRIMARY KEY,
    uri_redirect        VARCHAR(220) NOT NULL
);

CREATE TABLE IF NOT EXISTS client
(
    nu_seq_client              serial PRIMARY KEY,
    client_id                  VARCHAR      NOT NULL UNIQUE,
    client_secret              VARCHAR      NOT NULL,
    token_endpoint_auth_method VARCHAR      DEFAULT 'client_secret_post' NOT NULL,
    client_name                VARCHAR(120) NOT NULL,
    grant_type                 VARCHAR(30)  NOT NULL DEFAULT 'authorization_code',
    client_id_issued_at        timestamp             default now(),
    client_secret_expires_at   timestamp    NOT NULL
);

CREATE TABLE IF NOT EXISTS users
(
    nu_seq_users serial PRIMARY KEY,
    username     VARCHAR(25) NOT NULL UNIQUE UNIQUE,
    email        VARCHAR(70) NOT NULL UNIQUE UNIQUE,
    password     VARCHAR     NOT NULL,
    code         VARCHAR(64),
    dt_code      timestamp,
    authorize    BOOLEAN default false
);

CREATE TABLE IF NOT EXISTS users_scope
(
    nu_seq_users_scope serial PRIMARY KEY,
    ds_scope           VARCHAR(15) NOT NULL
);

-- CREATE TABLE IF NOT EXISTS authrization_code
-- (
--     nu_seq_authorization_code serial PRIMARY KEY,
--     code           VARCHAR(64) NOT NULL,
--     nu_seq_users   INTEGER NOT NULL,
--
--     CONSTRAINT nu_seq_authorization_code FOREIGN KEY (nu_seq_users) references users (nu_seq_users)
-- );

alter table users
    add nu_seq_users_scope integer not null,
    add constraint fk_nu_seq_users_scope
        foreign key (nu_seq_users_scope) references users_scope (nu_seq_users_scope);

alter table redirect_uri
    add nu_seq_client integer not null,
    add constraint fk_nu_seq_users_scope
        foreign key (nu_seq_client) references client (nu_seq_client);

alter table client_scope
    add nu_seq_client integer not null,
    add constraint fk_nu_seq_users_scope
        foreign key (nu_seq_client) references client (nu_seq_client);

-- insert into authorization_serve values (
--     DEFAULT,
--     '459580faac276b13c9ddb60d480c34f795aa5dabb8df4655e5a0d793d0b41c9a',
--     '1614aed6e5adb9f44d8c56370a9f77cb0940c221c4e14cdc86444576dae7af9d',
--     'http://myfinance.com.br:3030/check',
--     2
-- -- );
-- insert into scopes values (DEFAULT, 'create');
-- insert into scopes values (DEFAULT, 'read');
-- insert into scopes values (DEFAULT, 'update');
-- insert into scopes values (DEFAULT, 'delete');
