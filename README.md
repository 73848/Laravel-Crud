## Requisitos:
- PHP > -v 8
- Composer

## Como Rodar o projeto baixado: 
- Instalar o gerenciador de dependências composer: 

```
composer install
```

- Configure o banco de dados; 

- Duplique o arquivo '.env.example' e renomear para '.env';

- Execulte o comando 

```
php artisan migrate
```
para criar as tabelas no banco de dados cadastrado.

## Rodando o projeto 

- Inicie o banco de dados - nesse caso é o mysql - e rode o comando
  
  ```
  php artisan serve
  ```
  e vá até o localhost de sua máquina.
  
## Conclusão

- Esse é um simples guia para teste de conhecimentos envolvendo conceitos básicos de Laravel como routes, controllers, Eloquent ORM e migrations.

