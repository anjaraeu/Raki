# Raki

Raki is a full-featured file sharing utility.
It relies on Tus protocol to allow resumable uploads. 

## Features

- Upload 5 files and create a group
  - optional AES256 encryption with password
  - "single" downloads: deleted right after first download
  - custom expiration (from one day to one month)
  - create short link (with AnjaraLink or the integrated link shortener)
  - management link
- User accounts (totally optional)
  - All the uploads in a single dashboard
- Admin/Moderation panels
  - Report features (DMCA, non-ethical, etc...)
  - Admin dashboard with Horizon console

## Installation

You'll need to install [composer](https://getcomposer.org) for PHP dependencies, [Nodejs](https://nodejs.org) to compile assets. You'll also need [Redis](https://redis.io) to manage the ZIP generation queue.

First, install PHP dependencies:
```bash
composer install
```

Configure the .env file correctly:
```bash
cp .env.example .env
$EDITOR .env
php artisan key:generate
```

Then build assets:
```bash
yarn
cd resources/fomantic
npx gulp build
cd ../..
yarn production
```

Then setup the database:
```
php artisan migrate
```

To manage the download queue, you'll need to run the Horizon daemon, with the provided systemd unit:
```bash
sudo cp templates/files-horizon.service /etc/systemd/system/files-horizon.service
```
Don't forget to edit PATHTOPHP and PATHTORAKI to their respective values.


## SQLite
To use SQLite, replace the whole `DB_*` block by this line:
```
DB_CONNECTION=sqlite
```
You must also create the database file itself:
```bash
touch database/database.sqlite
```
