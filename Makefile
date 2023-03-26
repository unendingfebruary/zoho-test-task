start:
	php artisan serve

install:
	composer install
	cp -n .env.example .env
	php artisan key:generate
	php artisan migrate

lint:
	composer exec --verbose phpcs -- --standard=PSR12 app database routes tests

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 app database routes tests

test:
	php artisan test
