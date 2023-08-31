CREATE USER authservice WITH PASSWORD '@1a2u3t4h5_6s7e8r9v10i11c12e13';
CREATE DATABASE authorizations;
GRANT ALL PRIVILEGES ON DATABASE authorizations TO authservice;

insert into redirect_uri (nu_seq_redirect_uri, uri_redirect, nu_seq_client)
values (DEFAULT, 'https://financas.com.br:3030/check-token', 1);