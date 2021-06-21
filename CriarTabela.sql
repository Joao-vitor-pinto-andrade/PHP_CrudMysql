CREATE TABLE MBA_ALOC (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    cliente VARCHAR(100) NOT NULL,
    telefone_cliente VARCHAR(13),
    solicitacao VARCHAR(255) NOT NULL,
    endereco_cliente VARCHAR(255) NOT NULL,
    cpf_cnpj VARCHAR(12) NOT NULL
);

insert into mba_aloc(cliente,solicitacao,cpf_cnpj)
values('joao vitor','alocação',07865215380)

select * from MBA_ALOC
drop table mba_aloc