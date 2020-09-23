# New-Year-Calculator

## Installation

1. Clone repository

```sh
$ git clone https://github.com/bovsunovsky/New-Year-Calculator.git
```
2. Install dependencies

```sh 
$ composer install
```
3. Configure database connection

```sh
    $ mv .env .env.local
```
   
4. Create and run docker containers

```sh
    $ docker-compose up -d --build
```
   
5. Create a database and run migrations

```sh
    $ docker-compose exec php-fpm bash
    $ ./bin/console doctrine:database:create
    $ ./bin/console doctrine:migrations:migrate
```   


## Code style


To check the code style just run the following command


```bash
$ composer cs-check
```


to fix the code style run next command

```bash
$ composer cs-fix
