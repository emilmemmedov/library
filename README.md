<h1>Project Setup </h1>

<p>    1. docker-compose up -d --build </p>
<p>    2. docker-compose exec app php artisan key:generate </p>
<p>    3. docker-compose exec app php artisan config:cache </p>
<p>    4. docker-compose exec db bash </p>
<p>    5. mysql -u root -p </p>
<p>    6. GRANT ALL ON laravel.* TO 'laraveluser'@'%' IDENTIFIED BY 'your_laravel_db_password'; </p>
<p>    7. FLUSH PRIVILEGES; </p>
<p>    8. exit, exit </p>
<p>    9. docker-compose exec app php artisan migrate </p>
<p>    10. docker-compose exec app php artisan migrate:refresh --path=database/migrations/seed-versioning/2021_12_30_152025_create_authors_data.php </p>
<p>    11. docker-compose exec app php artisan migrate:refresh --path=database/migrations/seed-versioning/2021_12_30_152028_create_book_data.php </p>
<p>    12. docker-compose exec app php artisan migrate:refresh --path=database/migrations/seed-versioning/2021_12_30_152034_create_librarian_data.php </p>
<p>    13. docker-compose exec app php artisan migrate:refresh --path=database/migrations/seed-versioning/2021_12_30_152039_create_readers_data.php </p>
