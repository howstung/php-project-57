PORT ?= 8080

install:
		composer install

validate:
		composer validate

lint:
		composer exec phpcs -v

lint-fix:
		composer exec phpcbf

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

test-coverage-text:
		XDEBUG_MODE=coverage php artisan test --coverage-text

test-coverage-text-report:
		XDEBUG_MODE=coverage php artisan test --coverage-clover ./build/logs/clover.xml

test-coverage-html-report:
		XDEBUG_MODE=coverage php artisan test --coverage-html ./test-reports/html

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
