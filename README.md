# New-Year-Calculator

## Installation

1. Clone repository

```sh
$ git clone https://github.com/bovsunovsky/New-Year-Calculator.git
```

2. Configure database connection

```sh
    $ mv .env .env.local
```
   
3. Create and run docker containers

```sh
    $ docker-compose up -d --build
```

4. Install dependencies into container

```sh 
$ docker-compose exec php-fpm bash
$ composer install
```   

5. Create a database and run migrations into container

```sh
    $ ./bin/console doctrine:database:create
    $ ./bin/console doctrine:migrations:migrate
```   


## Code style


To check the code style just run the following command into container


```bash
$ composer cs-check
```


to fix the code style run next command into container

```bash
$ composer cs-fix
