# Baca - Online Quran Reader

![baca-image-cover](https://baca-opengraph.vercel.app/api/default?alt=1)

## Getting Started

Clone repo

```shell
git clone https://github.com/My-Quran-Tajwid/baca.git --recursive
```

If you git cloned without the `--recursive` flag, run this command to get the submodules:

```shell
git submodule update --init
```

Open the cloned folder and create an `.env` file

```shell
cp .env.example .env
```

Setup project:

```shell
composer install
npm install
php artisan key:generate
```

Fill in the Database connection information in the `.env` file. Easiest way to get started is using sqlite. Example:

```env
DB_CONNECTION=sqlite
DB_DATABASE=D:\Development\baca\database\app.sqlite
```

> [!TIP]
> Need help to setup MySQL database? Check out my article on how to setup MySQL server on a docker: https://iqfareez.com/blog/setup-docker-mysql-phpmyadmin

Migrate & Seed Database

```shell
php artisan migrate
php artisan db:seed
```

Run the development server

```shell
composer run dev
```

Open your application at http://127.0.0.1:8000
