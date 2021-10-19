
start: ## Start project
	# Running in detached mode.
	docker-compose up -d --remove-orphans --no-recreate
	# Start crons.
	docker-compose exec php crond
	# Start Mercure subscribers
	docker-compose exec -d php bin/console ngtv:mercure:subscribe

stop: ## Stop project
	docker-compose stop

add-fixtures: ## reset bdd and add fixtures
	docker-compose exec php bin/console hautelook:fixtures:load -n --purge-with-truncate

delcache: ## clear cache
	docker-compose exec php rm -rf var/cache

db-reset: ## update bdd
	docker-compose exec php bin/console doctrine:schema:update --force

add-entity:
	docker-compose exec php bin/console make:entity --api-resource

cs-fix: ## Run php cs fixer and fix errors
	docker-compose exec php ./vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix
