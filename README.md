# AnjaraFiles

La prochaine génération d'AnjaraFiles

## Installation

You'll need to install [composer](https://getcomposer.org) for PHP dependencies, [Nodejs](https://nodejs.org) to compile assets. You'll also need [Redis](https://redis.io) to manage the ZIP generation queue.

First, install PHP dependencies:
```bash
composer install
```

Then build assets:
```bash
npm i
cd resources/semantic
npx gulp build
cd ../..
npm run production
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

To manage the download queue, you'll need to run the Horizon daemon, with the provided systemd unit:
```bash
sudo cp templates/files-horizon.service /etc/systemd/system/files-horizon.service
```
Dont forget to edit PATHTOPHP and PATHTOFILES to their respective values.


## SQLite
To use SQLite, replace the whole `DB_*` block by this:
```
DB_CONNECTION=sqlite
```
You must also create the database file itself:
```bash
touch database/database.sqlite
```
