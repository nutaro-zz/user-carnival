.PHONY:build
build:
	docker-compose build

.PHONY:build-hard
build-hard:
	docker-compose build --no-cache

.PHONY:up
up:
	docker-compose up -d
	docker exec -i php bash -c "service apache2 reload"

.PHONY:down
down:
	docker-compose down

.PHONY:database
database:
	docker exec -i database bash -c "mysql -u root -psecret < /instruction.sql"