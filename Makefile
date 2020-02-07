.PHONY: all build deps composer-install composer-update composer reload test run-tests start stop destroy doco rebuild

current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

# Main targets

build: deps start

deps: composer-install

# Composer

composer-install: CMD=install
composer-update: CMD=update

# Usage example (add a new dependency): `make composer CMD="require --dev symfony/var-dumper ^4.2"`
composer composer-install composer-update:
	@docker run --rm --interactive --tty --volume $(current-dir):/app --user $(id -u):$(id -g) \
		clevyr/prestissimo $(CMD) \
			--no-ansi \
			--no-interaction

# Clear cache
# OpCache: Restarts the unique process running in the PHP FPM container
# Nginx: Reloads the server

reload:
	@docker-compose exec php kill -USR2 1
	@docker-compose exec nginx nginx -s reload
	@docker-compose exec db mariadb -s reload

# Docker Compose

start:
	@docker-compose up -d
	make fixtures

stop: CMD=stop

destroy: CMD=down

# Usage: `make doco CMD="ps --services"`
# Usage: `make doco CMD="build --parallel --pull --force-rm --no-cache"`
doco stop destroy:
	@docker-compose $(CMD)

rebuild:
	docker-compose build --pull --force-rm --no-cache
	make deps
	make start

fixtures:
	@docker-compose exec php bin/console doctrine:database:drop --force --if-exists -n
	@docker-compose exec php bin/console doctrine:database:create --if-not-exists -n
	@docker-compose exec php bin/console doctrine:schema:create -n
	@docker-compose exec php bin/console doctrine:fixtures:load -n