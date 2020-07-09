Настройка:
composer install
composer run-script post-autoload-dump
composer run-script post-root-package-install (windows) или cp .env.example .env (linux)
composer run-script post-create-project-cmd
php artisan migrate --seed
php artisan queue:listen

Инструкция API:
Заголовки:
Content-Type: application/json
Authorization: Bearer someToken

Список:
GET /api/participants
Параметры:
page - номер страницы
eventId - фильтрация по заданному мероприятию

Один:
GET /api/participants/{ид}

Добавить:
POST /api/participants
Пример тела запроса: {"firstName":"firstName", "lastName": "lastName", "email":"email@mail.ru","eventId": 1}

Редактировать:
PUT /api/participants/{ид}
Пример тела запроса: {"firstName":"firstName", "lastName": "lastName", "email":"email@mail.ru","eventId": 1}

Удалить:
DELETE /api/participants/{ид}
