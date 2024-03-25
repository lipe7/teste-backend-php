up:
	cp .env.example .env
	docker-compose up -d --build --force-recreate --remove-orphans
	docker-compose exec app php artisan key:generate
	docker-compose exec app php artisan cache:clear
	docker-compose exec app php artisan migrate
	docker-compose exec app php artisan vendor:publish
	docker-compose exec app php artisan optimize
	docker-compose exec app php artisan config:clear
	docker-compose exec app php artisan storage:link
down:
	docker-compose down
seed:
	docker-compose exec app php artisan db:seed
bash:
	docker exec -it grupo-bamaq-app bash
fresh-db:
	docker-compose exec app php artisan migrate:fresh --seed
test:
	docker-compose exec app php artisan test --env=testing
	docker-compose exec app php artisan config:clear
reset-env:
	docker-compose exec app php artisan config:clear
	docker-compose exec app php artisan config:cache
op:
	docker-compose exec app php artisan optimize
