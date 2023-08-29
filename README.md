# Сервис оценок достопримечательностей путешественниками

Сервис представляет собой систему оценок достопримечательностей путешественниками. Он обеспечивает полноценную работу с различными сущностями, позволяя манипулировать данными и получать выборки с применением различных фильтров.

## Сущности

### Достопримечательность
- Название
- Удаленность от центра города

### Город
- Название

### Путешественник
- Имя

## Дополнительные запросы к сущностям

- Получение списка достопримечательностей в конкретном городе
- Получение списка городов, посещенных конкретным путешественником
- Получение списка путешественников, побывавших в конкретном городе

## Отображение информации

При выводе информации о достопримечательностях следует предоставить следующие данные:
- Средняя оценка, вычисляемая на основе оценок всех путешественников.
- Возможность фильтрации по средней оценке.

## Версии

- PHP: 8.0.13.
- MySQL: 5.7.36
- PhpMyAdmin: 5.1.1
- Apache: 2.4.51
- WampServer: 3.2.6
- bootstrap: 5.1.3

## Установка и запуск

1. Клонируйте репозиторий: `git clone https://github.com/KostyaTarasov/TravelSpotRating.git`
2. Выполните composer install
3. Настройте окружение и базу данных. Подключение к БД в файле src/settings.php
 - 'host' => 'localhost:3306',
 - 'dbname' => 'service_travelers',
 - 'user' => 'root',
 - 'password' => '',
4. Запустите проект. В моём случае в настройках WampServer VirtualHost: http://travel-spot-rating/