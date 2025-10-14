USE sistema_bancario;

DROP PROCEDURE IF EXISTS clientePF_cadastrar;

DELIMITER $$

CREATE PROCEDURE IF NOT EXISTS clientePF_cadastrar (
    IN p_nome VARCHAR(100),
    IN p_email VARCHAR(100),
    IN p_telefone VARCHAR(15),
    IN p_endereco VARCHAR(255),
    IN p_username VARCHAR(50),
    IN p_password VARCHAR(255),
    IN p_cpf VARCHAR(14),
    IN p_data_nascimento DATE
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
    END;

    START TRANSACTION;

    INSERT INTO Clientes (nome, email, telefone, endereco, username, password)
    VALUES (p_nome, p_email, p_telefone, p_endereco, p_username, p_password);

    SET @last_id = LAST_INSERT_ID();

    INSERT INTO Clientes_PF (cliente_id, cpf, data_nascimento)
    VALUES (@last_id, p_cpf, p_data_nascimento);

    COMMIT;
END $$

DELIMITER ;
DROP PROCEDURE IF EXISTS clientePF_alterar;
DELIMITER $$
CREATE PROCEDURE IF NOT EXISTS clientePF_alterar (
    IN p_id INT,
    IN p_nome VARCHAR(100),
    IN p_email VARCHAR(100),
    IN p_telefone VARCHAR(15),
    IN p_endereco VARCHAR(255),
    IN p_username VARCHAR(50),
    IN p_password VARCHAR(255),
    IN p_cpf VARCHAR(14),
    IN p_data_nascimento DATE
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
    END;

    START TRANSACTION;

    UPDATE Clientes SET
        nome = p_nome,
        email = p_email,
        telefone = p_telefone,
        endereco = p_endereco,
        username = p_username,
        password = p_password
    WHERE id = p_id;

    UPDATE Clientes_PF SET
        cpf = p_cpf,
        data_nascimento = p_data_nascimento
    WHERE cliente_id = p_id;

    COMMIT;

    END$$
    DELIMITER ;
   



















DROP PROCEDURE IF EXISTS clientePJ_cadastrar;

DELIMITER $$
CREATE PROCEDURE IF NOT EXISTS clientePJ_cadastrar (
    IN p_id INT ,
    IN p_nome VARCHAR(100),
    IN p_email VARCHAR(100),
    IN p_telefone VARCHAR(15),
    IN p_endereco VARCHAR(255),
    IN p_username VARCHAR(50),
    IN p_password VARCHAR(255),
    IN p_cnpj VARCHAR(18),
    IN p_razao_social VARCHAR(100)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
    END;
    START TRANSACTION;
    INSERT INTO Clientes (nome, email, telefone, endereco, username, password)
    VALUES (p_nome, p_email, p_telefone, p_endereco, p_username, p_password);
    SET @last_id = LAST_INSERT_ID();
    INSERT INTO Clientes_PJ (cliente_id, cnpj, razao_social)
    VALUES (@last_id, p_cnpj, p_razao_social);
    COMMIT;
END $$

DELIMITER ;
