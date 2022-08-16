Приложение "Случайный фильм"

    Отображает случайный фильм из коллекции.
    Перед выполнением команд необходимо установить и запустить Chromedriver а так же установить браузер Chrome. 
    Версии Chromedriver и браузера должны совпадать.
    Команды для инициализации базы данных: 
    1. php artisan migrate 
    2. php artisan movies:init 
    3. php artisan movies:source
    4. php artisan queue:w
    
Системные требования:
- Apache 2.4 +
- PHP 7.4 +
- MariaDB 10.3 +
