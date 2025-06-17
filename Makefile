start:
	docker compose up --force-recreate -d

stop:
	docker compose down

install: start
	docker compose exec php composer install
	docker compose exec php ./bin/console doctrine:database:create --if-not-exists
	docker compose exec php ./bin/console doctrine:migration:migrate --no-interaction

phpstan:
	docker compose exec php ./vendor/bin/phpstan analyse src --configuration=phpstan.neon
