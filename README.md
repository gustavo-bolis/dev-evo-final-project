# dev-evo-final-project
start

Criar arquivo docker-compose.yml seguindo o docker-compose-example.yml
Criar arquivo .env seguindo o .env-sample
Criar arquivo app/back-end/parametros_db.php com base no app/back-end/parametros_db.php-sample

criar as tabelas:

CREATE TABLE rendimento (
->   id INT(11) NOT NULL AUTO_INCREMENT,
->   custoenergia DECIMAL(10,2) NOT NULL,
->   valor DECIMAL(10,2) NOT NULL,
->   moeda VARCHAR(20) NOT NULL,
->   PRIMARY KEY (id)
-> );