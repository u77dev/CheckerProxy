###Запуск проекта в консоли
````shell
docker-compose up -d
````
---
Затем спустимся в контейнер с php

````shell
docker exec -it ChekerProxy_php /bin/bash
````
---
Затем внутри контейнера поднимем composer и миграции

````shell
composer update
````
````shell
php artisan migrate
````
---
Главная страница будет доступна по ссылке [http://cp.localhost](http://cp.localhost)

