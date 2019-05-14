# AnjaraFiles

La prochaine génération d'AnjaraFiles

## Installation

You'll need to install [composer](https://getcomposer.org) for PHP dependencies, [Nodejs](https://nodejs.org) to compile assets.

First, install PHP dependencies:
```bash
composer install
```

Then build assets:
```bash
npm i
cd resources/semantic
npx gulp build
npm run production
cd ../..
```

Configure the .env file correctly:
```bash
cp .env.example .env
$EDITOR .env
php artisan key:generate
```

Then setup the database:
```
php artisan migrate
```
