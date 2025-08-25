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

install:
	${DOCKER_COMPOSE} build --no-cache
	${DOCKER_COMPOSE} up -d
	[ -f .env ] || cp .env.example .env

up:
	${DOCKER_COMPOSE} up -d

down:
	${DOCKER_COMPOSE} down

update:
	${DOCKER_COMPOSE} down
	git pull
	${DOCKER_COMPOSE} build --no-cache
	${DOCKER_COMPOSE} up -d
