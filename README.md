# CentOS на Virtual Box
(https://www.osboxes.org/centos/)
(https://www.ericlin.me/2016/05/how-to-ssh-into-centos-in-virtualbox/)
(https://www.linode.com/docs/databases/postgresql/how-to-install-postgresql-relational-databases-on-centos-7/)
(https://www.rosehosting.com/blog/how-to-install-php-7-2-on-centos-7/)
`Pass:osboxes.org`

```bash
ssh -p 2222 osboxes@127.0.0.1

sudo su -
systemctl stop packagekit
systemctl disable packagekit
yum remove PackageKit
yum install mc telnet
mkdir -p /var/www

sudo groupadd www-data
sudo usermod -a -G www-data $USER
sudo chown -R root:www-data /var/www
sudo chmod 2775 /var/www
```

Logout and login. Now test your permissions:

Ctrl+D

```bash
mkdir /var/www/test
rm -r /var/www/test

sudo yum install postgresql-server postgresql-contrib
sudo postgresql-setup initdb
sudo systemctl start postgresql

sudo passwd postgres
1234
psql -d template1 -c "ALTER USER postgres WITH PASSWORD '1234';"
createdb bi-tutorial -O postgres
```

```bash
mcedit /var/lib/pgsql/data/pg_hba.conf
```
```conf
  host    all             all             127.0.0.1/32            md5
  host    all             all             ::1/128                 md5
```

```bash
mcedit /var/lib/pgsql/data/postgresql.conf
```
```conf
  listen_addresses = '*'
```

```bash
sudo systemctl restart postgresql.service
```

Ctrl+D

```bash
sudo yum install git unzip

sudo yum install https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
sudo yum install yum-utils
sudo yum install http://rpms.remirepo.net/enterprise/remi-release-7.rpm
sudo yum-config-manager --enable remi-php72

sudo yum install php72 php72-php-fpm php72-php-pgsql php72-php-xml php72-php-xmlrpc php72-php-gd php72-php-mbstring php72-php-json
sudo ln -s /usr/bin/php72 /usr/bin/php

yum install php72-php-pgsql

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
HASH="$(wget -q -O - https://composer.github.io/installer.sig)"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
```

```bash
cd /var/www
composer create-project rozdol/bi-skel bi-tutorial dev-master

cd bi-tutorial
composer update
cp src/.env.example src/.env
mcedit src/.env

cd /var/www/bi-tutorial/public
php -S localhost:8000
```
# Подготовка проекта

- Установить Postgres не ниже 10 с пользовтелем postgres и паролем 1234 (потом можно поменять)
- И создать базу данных bi-tutorial
(https://www.digitalocean.com/community/tutorials/how-to-install-and-use-postgresql-on-ubuntu-18-04)

- PHP должен быть не ниже 7.0 и не выше 7.2 (7.3 - подглюкивает!)

- Проверить:
```bash
php -v
```
(https://www.tecmint.com/install-different-php-versions-in-ubuntu/)

 - Установить php библтотеки:
 ```bash
sudo apt-get update && sudo apt-get install curl php-cli php-mbstring git unzip
```

- Установить composer по интструкции :
(https://getcomposer.org/download/)

- Перейти в папку, где будет наш проект:
```bash
cd /var/www/
```

- Инициализировать проект через подготовленный скелетон:
```bash
composer create-project rozdol/bi-skel bi-tutorial dev-master
```

- Убрать унаследованную историю ответив ДА:
```bash
"Do you want to remove the existing VCS (.git, .svn..) history? [Y,n]?": Y
```

- Создать файл с установками значений констант окружения проекта:
```bash
cp bi-tutorial/src/.env.example bi-tutorial/src/.env
```

- Отредактировать файл bi-tutorial/src/.env:
```txt
[...]
APP_NAME='bi-tutorial'
[...]
DB_NAME='bi_tutorial'
[...]
```

- Перейти в папку, которая будет опубликована в общем доступе:
```bash
cd bi-tutorial/public
```

- Запустить php-шный вэбсеревер:
```bash
php -S localhost:8000
```

- В Браузере перейти на:
`http://localhost:8000/`

В первый запуск система создаст необходимые таблицы и через 10 секунд обновится на страницу приглашения логина
User: `admin`
Password: `Pass1234`

# Отделение бизнеслогики от движка
```bash
cd /var/www/

mkdir bi-projects

mv bi-tutorial/src bi-projects/bi-src-libmanager

ln -s $(pwd)/bi-projects/bi-src-libmanager bi-tutorial/src
```

### Инициализация версионности

Создайте новый репозитарий с именем `bi-src-libmanager`

(https://help.github.com/articles/creating-a-new-repository/)

```bash
cd bi-projects/bi-src-libmanager

git init
git add .
git commit -m 'initial'

git remote add origin git@github.com:rozdol/bi-src-libmanager.git
git push -u origin master
```
#### После изменений в коде

```bash
git status
git add .
git commit -m 'added changes to REANDME.md file'
git push
```

#### Обновить изменения из серевера в локальный код

```bash
git pull
```

# Замена главного меню
### Меню по умолчанию
`src/helpers/menu.html`

### Меню из базы данных
```bash
cd /var/www/bi-projects/bi-src-libmanager
mv helpers/menu.html helpers/menu_deleted.html
```

`$GLOBALS['settings']['fast_menu']=0;` в `config/config.php`
`$GLOBALS['settings']['app_loogo']=' '` - для удаления логотипа

# Цель
Создать аппликуху для управления библиотекой менеджерами без публичного доступа.

## Задачи
- Регистрация пользователей (users) - тех кто пользуется программой.
- Регистрация клиентов/посетителей - тех кто пользуется книгами, но не программой
- Поиск книги
- Выдача книги
- Возврат книги с отметкой рейтинга.
- Пополнение библиотеки
- Отчет “Книги в чтении”
- Отчет “Просроченные невозвраты”
- Отчет “Какие книги прочел посетитель”
- Отчет “Кто читал эту книгу"
- График “Визиты по дням"
- Функция “Напомнить вернуть книгу"
- Функция “Разослать клиентам список новых поступивших книг”
- Функция “Загрузить описание книги из внешнего источника”

# Добавление таблиц

`src/config/setup.sql` - файл для инициализации таблиц

# Инициализация начальных данных
`src/actions/tools/update.php`

```php
<?php
if (!$access['main_admin']) {
    $this->html->error('');
}
```
# Создание временных тестовых функций
Они нужны для того чтобы опробывать концепцию не засоряя основной код

`src/actions/test/*.php`

# API
В файле `src/.env` добавляем переменную `APP_SALT`

В деталях пользователя добавляем api-key и прописываем список доступных функций помимо стандарных (show, view, delete, update, insert). Доступ с ктандартным функциям определен в группе пользователя.

Пользуемся скриптом, который можно взять в `src/data/quiery.zip`

Запускаем в терминале, что бы получить id и name из books, где id>2

```bash
./query.sh admin Pass1234 show books
```

Изучаем функцию `generate_post_data()` в файле `query.sh`, что бы понять **fields** и **filters**.


Запросы можно делать в коммандной строке по примеру:
```bash
curl -H "Content-Type: application/json" -H "Accept: application/json" -X POST -d '{"user":"admin","pass":"Pass1234"}' http://localhost:8000/\?act\=api


curl -H "Content-Type: application/json" -H "Accept: application/json" -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsInVubSI6ImFkbWluIiwiZXhwIjoxNTUwNTY4NTI5fQ.pWihHlFaIHU98u8ovHFUJC5kXDnw8p8XJ6_SWxhg8BE" -X POST -d '{"user":"admin", "api_key":"87b101-1bdadf-0b2e36-513838-8b3005", "func":"show", "table":"books"}' http://localhost:8000/\?act\=api
```

# REST to Reuters
Закомментировать строки в файле `post_update.sh`

```bash
#rm -r ./public/assets
#rm -r ./bi
#rm -r ./src

#mv  tmp/public/assets ./public/
#mv  tmp/root/bi ./
#mv  tmp/src/src ./
```

Установить unirest
```bash
composer require mashape/unirest-php
```

