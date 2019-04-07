#!/bin/bash
red=`tput setaf 1`
green=`tput setaf 2`
reset=`tput sgr0`

user="xPand4B"
repo="MiPa-Pool"

echo ""
read -p "Give the ${repo} a Custom Name [${green}${user}-${repo}${reset}]: " input
echo ""

if [ -z "$input" ];
    then
    git clone "https://github.com/${user}/${repo}" "${user}-${repo}"
    cd "${user}-${repo}"
else
    git clone "https://github.com/${user}/${repo}" "${input}"
    cd "${input}"
fi;

echo ""

cp .env.example .env
# npm install
composer install

php artisan storage:link
php artisan key:generate
# php artisan brand:color

echo ""
read -n 1 -p "Do you want to install all database related stuff as well? [y/n] " input2
echo ""

if [ "$input2" == "y" ];
    then
    echo ""
    echo ""
    echo "${green}Open the .env file and fill in your database credentials.${reset}"
    echo ""
    echo "If you are done press any button to continue..."
    read -n 1 -s -r -p ""
    echo "Sure?"
    read -n 1 -s -r -p ""
    echo ""

    php artisan migrate
    echo ""

    echo ""
    read -n 1 -p "Should the database be seeded with fake data? [y/n] " input3
    echo ""

    if [ "$input3" == "y" ];
        then
        php artisan db:seed
        echo ""
    fi;

    php artisan serve
fi;
