PORT ?= 8080

install:
		composer install

validate:
		composer validate

lint:
		composer exec --verbose phpcs -- --standard=PSR12 app routes

lint-fix:
		composer exec phpcbf -- --standard=PSR12 -v app routes

start:
		php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT}

dev:
		php artisan serve --host=0.0.0.0 --port=${PORT}

test:
		php artisan test

seed:
		php artisan db:seed

migrate:
		php artisan migrate
