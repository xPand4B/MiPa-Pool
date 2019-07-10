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
composer install

php artisan storage:link
php artisan key:generate

echo ""
read -n 1 -p "Do you want to do all database related stuff as well? (Required to run tests) [y/n] " input2
echo ""

if [ "$input2" == "y" ];
    then
    echo ""
    echo ""
    echo "${green}Open the .env file and fill in your database credentials.${reset}"
    echo ""
    echo "If you are done press any button to continue..."
    xdg-open .env
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

    echo ""
    echo "Would you like to run all tests to see if everything is working just fine?"
    echo ""
    echo "If not please report the error to ${green}xpand.4beatz@gmail.com${reset}"
    echo "or create an issue at ${green}https://github.com/xPand4B/MiPa-Pool/issues/new/choose${reset}."
    echo ""
    read -n 1 -p "[y/n]" input4
    echo ""
    echo ""

    if [ "$input4" == "y" ];
        then
        sudo apt install php-sqlite3
        touch database/database.sqlite
        vendor/bin/phpunit
        echo ""
    fi;
fi;
