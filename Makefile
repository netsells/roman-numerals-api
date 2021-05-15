init:
	cp .env.example .env
	php artisan key:generate
	composer install
	composer dump-autoload -o

build:
	./vendor/bin/sail build --force-rm --no-cache
	make up

up:
	./vendor/bin/sail up -d

down:
	./vendor/bin/sail down

shell:
	./vendor/bin/sail root-shell

destroy:
	./vendor/bin/sail down --rmi all -v
	docker network prune
	docker system prune -a
