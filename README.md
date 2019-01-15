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
DB_NAME='bi-tutorial'
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

```bash
cd bi-projects/bi-src-libmanager

git init
git add .
git commit -m 'initial'

git remote add origin git@github.com:rozdol/bi-src-libmanager.git
git push origin master
```

