Требования к развёртыванию проекта:
1) PHP v7.0+
2) Composer
3) PostgreSQL / MySQL / другая реляционная СУБД.

Сначала перейдите в директорию, где хотите развернуть проект:
- cd /path/to/www

Склонируйте проект из GitHub репозитория:
- git clone git@github.com:RiverFisher/text-handler.git

Создайте БД, пользователя БД с паролем к ней, назначьте права пользователю:
конфигурация находится в файлах
- config/packages/doctrine.yaml - для PostgreSQL нужно указать драйвер pdo_pgsql и версию, для MySQL драйвер pdo_mysql, версию и кодировку
- .env - в строке 16 укажите конфигурацию подключения к БД

Если этих файлов нет, значит, они появятся после загрузки зависимостей composer'ом, и этот шаг нужно будет выполнить позже

Установите недостающие зависимости:
- composer self-update
- composer install
- composer update

Если возникают ошибки, убедитесь, что пользователь имеет достаточно прав на выполнение операций:
- sudo chmod -R 755
- sudo chown www-data:www-data ./*

Создайте схему БД:
- bin/console doctrine:schema:update --force

Для запуска build-in web сервера используйте одну из следующих команд:
- php -S 127.0.0.1:8000
- bin/console server:start (и можно в этом же сеансе терминала выполнять другие команды, для прекращения работы используйте команду bin/console server:stop)
- bin/console server:run (аналогично первой команде).

Пройдите по маршруту 127.0.0.1:8000/job

Удачи!
