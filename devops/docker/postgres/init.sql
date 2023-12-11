CREATE USER authservice WITH PASSWORD '@1a2u3t4h5_6s7e8r9v10i11c12e13';
CREATE DATABASE authorizations;
GRANT ALL PRIVILEGES ON DATABASE authorizations TO authservice;

insert into redirect_uri (nu_seq_redirect_uri, uri_redirect, nu_seq_client)
values (DEFAULT, 'https://financas.com.br:3030/check-token', 1);

insert into client (client_id, client_secret, client_name, client_secret_expires_at)
values (
    'e29bd183f7d5f19a3e74ac7abaf855323926ccb3f3fc5e02336ad5ed59aa774f5f397f13a498db4d51f1cb4ed62c2dc46e0ebc82162d64801ad8edb681d4710f',
    'f0fd856f850f0ddefcf3e200317612748fdba4fca187f58ef0d531035dd32c7f08d831fef3583b5a034065fdac73d03f3470370f2d6c2c6bdaa62fecf5b2ce73',
    'financas',
    '2024-12-11 19:15:52.000000'
);

insert into redirect_uri (nu_seq_redirect_uri, uri_redirect, nu_seq_client)
values (DEFAULT, 'http://www.financa-service.com.br:3030/check', 1);

insert into client_scope (ds_scope, nu_seq_client)
values ('read', 1);
insert into client_scope (ds_scope, nu_seq_client)
values ('create', 1);
insert into users (nu_seq_users, username, email, password, nu_seq_users_scope)
values (
        DEFAULT,
        'guilherme',
        'teste@teste.com',
        '$argon2i$v=19$m=65536,t=4,p=1$aHpIRW9hc0pRNjJCNWdGeQ$UTlAY89Bl9Try7hkrdvM6BFLLMPIHFzh3dNxTOatyRk',
        1
);