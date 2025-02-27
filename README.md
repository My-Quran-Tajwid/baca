# Baca - Online Quran Reader

## Getting Started

### Normal

Clone repo, create .env file, and setup project

```shell
git clone https://github.com/My-Quran-Tajwid/baca.git
cd baca
composer install
npm install
```

Copy environment file & generate app key

```
cp .env.example .env
php artisan key:generate
```

Fill in the Database connection information in the `.env` file. Easiest way to get started is using sqlite. Example:

```env
DB_CONNECTION=sqlite
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

### Using Dev Containers

About Dev Containers: https://code.visualstudio.com/docs/devcontainers/containers

After container has completed its build. Run the following commands.

```shell
cp .env.example .env && \
php artisan key:generate && \
php artisan migrate && \
php artisan db:seed DatabaseSeeder && \
```
```shell
npm run build
```
```shell
git submodule init && git submodule update
```