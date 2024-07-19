# Desafio Increazy

O projeto em questão é o resultado de um desafio da increazy, conforme esse documento do [notion](https://increazy.notion.site/Teste-Desenvolvedor-backend-62b7e24e6218412cbf1ab36aef46f603) 

O projeto foi feito utilizando o framework [Lumen](https://lumen.laravel.com/docs).
Você pode abrir o projeto no devcontainer(a pasta ta na raiz do projeto), caso não tenha o php e composer na sua maquina(ou não queira "suja-la" com dependência que não vai usar).

# Executando o projeto 

## Manualmente
instale as dependencias do projeto:
```bash
cd src
composer install 
```
depois, inicie o servidor:
```bash
php -S 0.0.0.0:8080 -t public
```
## com docker-compose
```bash
cd src
docker-compose up -d
```

Após seguir os passos acima, basta mandar requisições para localhost:{porta}/search/local/{ceps} , por exemplo:
```bash
curl http://localhost:8080/search/local/01001-000,68460-205
```

# Site no ar
Para o desafio, eu deixei um caminho aberto no meu servidor pessoal, segue uma requisição para a rota: 
```bash
curl https://increazy.adnangonzagaci.com/search/local/01001-000,68460-205
```