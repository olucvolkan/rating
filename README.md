# Rating System

## Getting Started

## Build Docker
```
docker-compose build
```
```
docker-compose up -d
```
```
docker-compose exec php /bin/bash
cp .env .env.local 
```
``` 
composer install
```

## Migration file run and fixtures load
```
 php bin/console doctrine:migrations:migrate
 ```
```
php bin/console doctrine:fixtures:load
```



##E2e Test

```
 php bin/console --env=test doctrine:database:create
```
``` 
php bin/console --env=test doctrine:schema:create
```
```
php bin/console --env=test doctrine:fixtures:load
```
```
php bin/phpunit
```
Output should be same!
[![image](https://www.linkpicture.com/q/Screenshot-2023-04-29-at-22.42.14.png)](https://www.linkpicture.com/view.php?img=LPic644d73aa4eb311958195950)


You can find postman collection inside app folder.





