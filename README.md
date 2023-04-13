# Dev Evo Final Project

## Início

1. Criar arquivo `docker-compose.yml` seguindo o exemplo em `docker-compose-example.yml`.
2. Criar arquivo `.env` seguindo o exemplo em `.env-sample`.
3. Criar arquivo `app/back-end/parametros_db.php` com base no exemplo em `app/back-end/parametros_db.php-sample`.
4. Execute o comando `docker compose up -d --build.
5. Conectar no container mariadb com o comando: ``docker compose exec -it mariadb  bash`` e rodar o comando `mariadb -u root -d devEvolution -p <senha do mysql .env>`.
6. Execute a instruções SQL abaixo.
## Criar as tabelas

Execute os seguintes comandos SQL para criar as tabelas necessárias:

```sql
CREATE TABLE rendimento (
  id INT(11) NOT NULL AUTO_INCREMENT,
  custoenergia DECIMAL(10,2) NOT NULL,
  valor DECIMAL(10,2) NOT NULL,
  moeda VARCHAR(20) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  user VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE gpu (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50) NOT NULL,
  fabricante VARCHAR(50) NOT NULL,
  tdp INT NOT NULL,
  rendimento INT NOT NULL,
  memsize INT NOT NULL
);
```
## Primeiro Login

Ao fazer o primeiro login, o sistema verificará se existe algum usuário registrado. Caso não exista, uma tela para criar o usuário inicial será exibida.
