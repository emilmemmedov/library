<h1>Project Setup </h1>

<p>
    1. docker-compose up -d --build
    2. docker-compose exec app php artisan key:generate
    3. docker-compose exec app php artisan config:cache
    4. docker-compose exec db bash
    5. mysql -u root -p
    6. GRANT ALL ON laravel.* TO 'laraveluser'@'%' IDENTIFIED BY 'your_laravel_db_password';
    7. FLUSH PRIVILEGES;
    8. exit, exit
    9. docker-compose exec app php artisan migrate
    10. docker-compose exec app php artisan migrate:refresh --path=database/migrations/seed-versioning/2021_12_30_152025_create_authors_data.php
    11. docker-compose exec app php artisan migrate:refresh --path=database/migrations/seed-versioning/2021_12_30_152028_create_book_data.php
    12. docker-compose exec app php artisan migrate:refresh --path=database/migrations/seed-versioning/2021_12_30_152034_create_librarian_data.php
    13. docker-compose exec app php artisan migrate:refresh --path=database/migrations/seed-versioning/2021_12_30_152039_create_readers_data.php
</p>
