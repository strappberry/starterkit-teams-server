PHP = php
COMPOSER = composer
CMD_INSTALL_NODE=./scripts/node-dependencies
CMD_BUILD_NODE=./scripts/node-build
SUPERVISOR = starter_worker:*
REPO_UPSTREAM = git@github.com:strappberry/starterkit-teams-server.git

composer_prod:
	$(COMPOSER) install --no-interaction --prefer-dist --optimize-autoloader --no-dev

composer_dev:
	$(COMPOSER) install --no-interaction

install_precommit:
	@ln -sf ./scripts/pre-commit .git/hooks/pre-commit

artisan_key:
	$(PHP) artisan key:generate

artisan_clear:
	$(PHP) artisan optimize:clear

artisan_optimize:
	$(PHP) artisan config:cache
	$(PHP) artisan event:cache
	$(PHP) artisan route:cache
	$(PHP) artisan view:cache

artisan_storage_link:
	$(PHP) artisan storage:link

format_code:
	./vendor/bin/pint

npm_install:
	$(CMD_INSTALL_NODE)

build_assets:
	$(CMD_BUILD_NODE)

copy_env:
	cp .env.example .env

pull:
	git pull

migrate_force:
	$(PHP) artisan migrate --force

supervisor_restart:
	sudo supervisorctl restart $(SUPERVISOR)

set_upstream:
	git remote add upstream $(REPO_UPSTREAM)
	git fetch upstream
	git rebase upstream/main

fetch_upstream:
	git fetch upstream
	git rebase upstream/main

set_version:
	./scripts/version

suggestions_production:
	@echo "\033[0;31m------------------------------------------------------"
	@echo "        Strappberry Development Team"
	@echo "------------------------------------------------------\033[0m"
	@echo ""
	@echo "Bienvenido a la instalación de la aplicación"
	@echo ""
	@echo "Por favor configure su archivo .env"
	@echo "- Nombre y url de la app"
	@echo "- Conexión a la base de datos"
	@echo "- Conexión a sentry"
	@echo "- Conexión a smtp"
	@echo "- Etc..."
	@echo "------------------------------------------------------"
	@echo "Para finalizar ejecute:"
	@echo "make update"
	@echo "------------------------------------------------------"

install: copy_env composer_prod artisan_key artisan_storage_link npm_install suggestions_production

install_dev: copy_env composer_dev artisan_key artisan_storage_link npm_install install_precommit

update: pull composer_prod migrate_force build_assets set_version artisan_clear artisan_optimize
