.PHONY:build
build:
	docker-compose build

.PHONY:up
up:
	docker-compose up -d

.PHONY:down
down:
	docker-compose down

.PHONY:database
database:
	docker exec -i database bash -c "mysql -u root -psecret < /instruction.sql"