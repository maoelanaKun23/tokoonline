Login dengan:

Username: laraveluser

Password: secret

docker exec -it laravel-app bash
php artisan serve --host=0.0.0.0 --port=8000
docker compose up -d
docker compose down
docker compose up -d --build
docker exec -it laravel-app bash
php artisan migrate
docker-compose exec app bash
