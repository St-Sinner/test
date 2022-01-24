# Обзор концепции
Для реализации взял свой laravel kit с докером который содержит определенный функционал (авторизация пользователя и какие то базовые возможности), в данном задании это ни какой роли не играет и может быть удалено...

## CalculationRequest.php
Можно добавить валидацию наличия id товаров в БД, но т.к. по заданию реализовывать структуру таблиц не требовалось - не стал добавлять проверку.

## CartController.php
Расположение App\Controllers\Api\CartController.php.
Входная точка для расчета цен продуктов /cart/calculate.
Принимает request, данные которого валидируются с помощью CalculationRequest, делегирует обработку некому сервисному слою в качестве которого выступает UseCase (одна операция, одно действие).

## CartCalculationUseCase.php
Расположение App\UseCases\CartCalculationUseCase.php.
UseCase - некий слой который может быть переиспользован в разных контроллерах, в консоли итд. Что дает хорошую возможность в тестировании отдельных кусков приложения.
Данный класс принимает массив, обрабатывает его и отдает реазультат. Более верно было бы жестко зафиксировать формат результата с помощью DTO (Data Transfer Object) класса, но в данном абстрактном тестовом задании не стал этого делать.

## ExternalCalculateClient.php
Расположение App\Clients\ExternalCalculateClient.php.
Независимый от фреймворка класс для взаимодействия с удаленным микросервисом хранения цен товаров. Может быть переиспользован в рамках другого приложения.
Принимает параметры:
- $url - ссылка на микросервис (в реальной жизни скорее всего у микросервиса будут и другие эндпоинты по этому в реальной жизни тут будет хост а не конечный url, а в класс добавится метод для построения url-а до эндпоинта)
- $client - http клиент для выполнения http запросов в данном случае GuzzleHttp\ClientInterface
- $logger - логирование request, response в данном случае Psr\Log\LoggerInterface, при необходимости можно заглушить  Psr\Log\NullLogger
- $logChannel - опционально, определен по умолчанию, канал для записи логов, в данном случае настроен (config/logging.php) в папку storage/logs/external-client и сгруппирован по дням

Также необходимо добавить обработчик ошибок для отлавливания проблем (отсутствие товара и т.п.) взаимодействия со внешним микросервисом.
Возможно так же нужен будет для работы данного класса токен итд...
Можно было предусмотреть что подобных клиентов для взаимодейтсвия с API в приложении будет много, и можно было сформировать и вынести общие методы такие как request в отдельную абстракцию, но в данном случае считаю это избыточным.

## ExternalCalculateServiceProvider.php
Расположение App\Providers\ExternalCalculateServiceProvider.php.
Так как мы используем Laravel воспользуемся его ServiceProvider возможностями для конфигурации и инжекта зависимостей класса.

###### P.S.
###### Часто на подобные микросервисы в будущем возлагают так называемую программу лояльности (промокоды, расчет скидки если покупаешь 2 товара, итд) в этом случае необходимо будет отправлять всю корзину и отказаться от кеширования...

<a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt=""></a>

## Quickstart
1. [Install docker](https://docs.docker.com/install/)
2. [Install docker-compose](https://docs.docker.com/compose/install/)
3. Install traefik

##Install
Copy .env file (update if required)

Полная установка приложения в Docker 
```
make install
```

Для подключения к рабочему окружению 
```
make env
```

Установка **composer**
```
make composer-install
```

Выполнение команд **composer**
```
make composer-command command="require \"packege/packege\":\"dev-master\""
```

Установка миграций
```
make migrate
```

Установка сидов
```
make artisan-seed
```

Генерация _ide-helper.php
```
make generate-ide-helper
```

Выполнение **artisan** команд
```
make artisan-cmd cmd="command"
```

## Yarn

Установка пакетов из `yarn.lock`
```
make yarn-install
```

Добавление пакета в `package.json`
```
make yarn-command command="add package:0.1"
```

Сборка в dev режиме
```
make yarn-dev
# or 
make yarn-watch
```

Сборка в prod режиме
```
make yarn-prod
```

## DEMO

`administrator` role account
```
Login: admin@example.com
Password: admin
```
