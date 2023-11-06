#!/bin/sh

if [ -z "$(which bundle)" ]; then
    echo "Instalando Ruby Bundler..."
    sudo apt -y install ruby-bundler
fi
