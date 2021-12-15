# assignment-symfony

## Getting started

1. Start the Docker containers:

```bash
docker-compose up -d
```

2. Run composer but in the container:

```bash
docker-compose exec php-fpm composer install
```

3. You should now see the Symfony welcome page on http://localhost.

## Symfony CLI

We also have to run the Symfony CLI utility inside the Docker container:

```bash
docker-compose exec php-fpm symfony 
```

Please note that we don't need to run a webserver with the Symfony CLI utility anymore.
