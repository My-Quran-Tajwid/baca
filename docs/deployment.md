# Deployment

## Using Docker

<!-- TODO -->

## Using CloudPanel

This app was deployed using [CloudPanel](https://www.cloudpanel.io/docs/v2/getting-started/) on a VPS previously, before I moved to using Docker (see above). The top level steps are as follows:

1. Create a new site in CloudPanel. Choose 'Laravel 12' (or later) as the application type.
2. SSH into the server using the site's user and password. Or you can add your SSH public key to the site settings and use that to login.
3. Install [node](https://nodejs.org/en). See https://www.cloudpanel.io/docs/v2/php/guides/nodejs/
4. Clone the site code from the GitHub repository into the site's root directory. For example:

    ```bash
    cd htdocs/baca.qurantajwid.my
    git clone https://github.com/My-Quran-Tajwid/baca.git . --recursive
    composer install
    ```

5. Create the `.env` file.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
6. Create a database for the site and update `.env` file accordingly.Then, do the migration and seeder.
    ```bash
    php artisan migrate --seed
    ```
7. Setup the DNS to point to that server. Create new Let's Encrypt SSL certificate for the site.
8. The site should be up and running.
