#!/bin/sh

GITHUB_TOKEN=$(grep oauth_token ~/.config/gh/hosts.yml | cut -d":" -f2 | cut -c2-) make -f Makefile.proyecto
