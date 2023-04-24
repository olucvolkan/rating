# Basic Reservation

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
![alt text](https://www.linkpicture.com/q/Screenshot-2023-03-12-at-09.50.58.png)



## DB structure
![alt text](https://www.linkpicture.com/q/Screenshot-2023-03-12-at-00.31.32.png)

You can use postman collection in project root folder.

##Example Request

```
curl --location 'http://127.0.0.1:8080/home/1' | jq
```

```
   % Total    % Received % Xferd  Average Speed   Time    Time     Time  Current
                                 Dload  Upload   Total   Spent    Left  Speed
100   185    0   185    0     0   2466      0 --:--:-- --:--:-- --:--:--  2466
{
  "payload": {
    "home": {
      "id": 1,
      "name": "Emmanuel Rogahn",
      "description": "David Renner",
      "location": "27692 Devin Walks",
      "address": "4275 Skyla Field Suite 525\nNew Rosinaville, NH 17519-2024"
    }
  }
}
```

```
 curl --location 'http://127.0.0.1:8080/search?checkInDate=12.03.2023&checkOutDate=13.03.2023' | jq
```

```
   % Total    % Received % Xferd  Average Speed   Time    Time     Time  Current
                                 Dload  Upload   Total   Spent    Left  Speed
100   663    0   663    0     0    173      0 --:--:--  0:00:03 --:--:--   172
{
  "payload": {
    "homes": [
      {
        "id": 3,
        "home": {
          "id": 3,
          "name": "Herta Hahn III"
        },
        "fromDate": "2023-03-11T00:00:00+00:00",
        "toDate": "2023-03-13T00:00:00+00:00"
      },
      {
        "id": 4,
        "home": {
          "id": 4,
          "name": "Jordi Jacobi"
        },
        "fromDate": "2023-03-11T00:00:00+00:00",
        "toDate": "2023-03-14T00:00:00+00:00"
      },
      {
        "id": 5,
        "home": {
          "id": 5,
          "name": "Phoebe Corkery DVM"
        },
        "fromDate": "2023-03-11T00:00:00+00:00",
        "toDate": "2023-03-15T00:00:00+00:00"
      },
      {
        "id": 6,
        "home": {
          "id": 6,
          "name": "Prof. Belle Kassulke Sr."
        },
        "fromDate": "2023-03-11T00:00:00+00:00",
        "toDate": "2023-03-16T00:00:00+00:00"
      },
      {
        "id": 7,
        "home": {
          "id": 7,
          "name": "Dr. Gavin Osinski"
        },
        "fromDate": "2023-03-11T00:00:00+00:00",
        "toDate": "2023-03-17T00:00:00+00:00"
      }
    ]
  }
}
```