 * Docker env
```
$ cp .env-example .env
```

* Laravel env
```
$ cd src
$ cp .env.example .env
```

* Build docker
```
$ cd ..
$ docker-compose up -d --build
```

* Composer install
```
$ docker-compose exec laravel-test composer install
```

* Migrate
```
$ docker-compose exec laravel-test php artisan migrate
```

* NPM
```
$ docker-compose exec laravel-test npm install
$ docker-compose exec laravel-test npm run prod
```

