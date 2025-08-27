include .env
DOCKER_COMPOSE=docker compose

.ONESHELL:
.PHONY: help

H1=echo === ${1} ===
BR=echo
TAB=echo "\t"

help:
	@$(call H1,Application)
	$(TAB) make install - Build and start services
	$(TAB) make up - Start services
	$(TAB) make update - Git pull, rebuild and restart services
	$(TAB) make down - Stop and delete services
	$(TAB) make test-php - Run PHP tests

install:
	${DOCKER_COMPOSE} build
	${DOCKER_COMPOSE} up -d
	[ -f .env ] || cp .env.example .env
	${DOCKER_COMPOSE} exec php composer install
	${DOCKER_COMPOSE} exec php composer db-migrate

up:
	${DOCKER_COMPOSE} up -d

down:
	${DOCKER_COMPOSE} down

update:
	${DOCKER_COMPOSE} down
	git pull
	make install

test-php:
	${DOCKER_COMPOSE} exec php composer fix
	${DOCKER_COMPOSE} exec php composer test
