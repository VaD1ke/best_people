## Введение
Проект представляет собой веб-сайт, который позволяет людям голосовать друг за друга и определить, кто лучший человек Интернета.

## Требования
Необходимые компоненты:
* php 5.4+
* mysql
* php5-fpm
* php5-mysql
* php gd 2

## Установка
1. Создайте базу данных в mysql

2. Сотворите файл .env по шаблону файла .env.example

3. В нем запишите в нужные константы соответствующие данные. В DB_DATABASE запишите созданную перед этим базу данных (пункт 1) Например:   
 `DB_DATABASE=your_database_name   
  DB_USERNAME=your_database_login   
  DB_PASSWORD=your_database_password`

4. В том же файле допишите внизу файла следующие константы и значения (будет необходимо для капчи):   
 `NOCAPTCHA_SECRET=[6LfJHQMTAAAAANU0yipkKhcBvz132oIfhSwKkBPO]   
  NOCAPTCHA_SITEKEY=[6LfJHQMTAAAAABzb9KPA9IhxKWo-_hEbtxqBqfea]`

5. В корне проекта запустите миграции:
 `php artisan migrate`

6. ???????

7. PROFIT!
