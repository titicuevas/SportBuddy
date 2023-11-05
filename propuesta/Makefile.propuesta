.PHONY: all check pandoc

all: check propuesta.pdf

check: pandoc vendor vendor/bundle

pandoc:
	@scripts/check-pandoc.sh

vendor:
	@composer install

vendor/bundle:
	@scripts/check-bundler.sh
	@bundle config set path 'vendor/bundle'
	@bundle install

propuesta.pdf: requisitos.xls propuesta.md
	@php scripts/requisitos.php
	@pandoc -f markdown-smart -s propuesta.md requisitos.md -o pro.adoc
	@scripts/replace.sh
	@echo "Generando propuesta.pdf..."
	@bundle exec asciidoctor-pdf propuesta.adoc
	@rm -f pro.adoc propuesta.adoc
