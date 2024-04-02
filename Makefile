PORT ?= 8080

install:
		composer install

validate:
		composer validate

lint:
		composer exec --verbose phpcs -- --standard=PSR12 app routes tests database lang routes

lint-fix:
		composer exec phpcbf -- --standard=PSR12 -v app routes tests database lang routes

start:
		php artisan serve --host=0.0.0.0 --port=${PORT}

dev:
		php artisan serve --host=0.0.0.0 --port=${PORT}

test:
		php artisan test

seed:
		php artisan db:seed

migrate:
		php artisan migrate

github_actions:
		php --version
		composer validate
		composer install
		cp .env.ci .env
		php artisan key:gen
		php artisan migrate:fresh
		npm ci
		npm run build
		composer exec --verbose phpcs -- --standard=PSR12 app routes tests
		php artisan test
