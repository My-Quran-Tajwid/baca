# Deployment

## Using Docker

The [`compose.prod.yml`](../compose.prod.yaml) file can be used to deploy the app using Docker. My current setup uses Portainer as the UI for managing deployments. So, all the steps written below assume you are using Portainer.

First, if you don't have reverse proxy setup already, you can follow the steps below to set it up using Caddy. If you already have one, skip to the next section.

### Setup Caddy

Create a new network for the reverse proxy:

```bash
docker network create proxy
```

Then, create a new stack for Caddy. Choose method **Web Editor**. Paste the following docker compose content into the text editor.

```
services:
  caddy:
    image: caddy:2.11-alpine
    restart: unless-stopped
    ports:
      - "80:80"
      - "443:443"
      - "443:443/udp"
    volumes:
      - ./conf:/etc/caddy
      - ./site:/srv
      - caddy_data:/data
      - caddy_config:/config
    networks:
      - proxy

volumes:
  caddy_data:
  caddy_config:

networks:
  proxy:
    external: true
```

Deploy the stack. Now, we need to create [the Caddyfile](https://caddyserver.com/docs/caddyfile) to store our config. Locate where the stack is stored on the machine (look in the url parameter for `id`. For example `?id=7` indicates the stack is stored in `/data/compose/7`)

```shell
touch /data/compose/7/conf/Caddyfile
```

We will get back to the Caddyfile later. For now, let's move on to deploying the app.

### Setup the app

Create a new stack for the app. Choose method **Repository**. Fill in the fields:

- Repository URL: `https://github.com/My-Quran-Tajwid/baca`
- Compose file path: `compose.prod.yaml`

(Or you can paste the content of [`compose.prod.yaml`](../compose.prod.yaml) into the Web Editor.)

Next, in the Environment variables section. Change to Advanced mode, copy the content of [`.env.example`](../.env.example) file and paste it into the text area. Update the values accordingly. Minimum changes required are:

```dotenv
APP_KEY=base64:em0iEi82hy5UbGM3U1RYlyXOAY41za3esxyWGsOWEAA= # generate your own key
APP_URL=https://baca.qurantajwid.my

DB_HOST=db # database service name defined in the compose file
```

> [!IMPORTANT]
> The value `AUTORUN_LARAVEL_MIGRATION_SEED=true` & `AUTORUN_LARAVEL_MIGRATION_MODE=fresh` is only needed on the first run to create the tables and seed the data. After that, you can set `AUTORUN_LARAVEL_MIGRATION_SEED=false` & `AUTORUN_LARAVEL_MIGRATION_MODE=default` to prevent it from running on every start. Or you can remove those environment variables entirely.

> [!TIP]
> You can generate the `APP_KEY` value by running `php artisan key:generate --show` command in your local environment. Or using online tools like https://appkeyforlaravel.com/

> [!NOTE]
> For production deployments, set the environment variable `APP_ENV` to `production` and `APP_DEBUG` to `false`.

Click on Deploy the stack. Wait for the deployment to finish. You should see the new stack running.

Now, we get back to the Caddyfile so that we can access the app publicly. Open the Caddyfile and add the following content (for example):

```Caddyfile
baca.qurantajwid.my {
    reverse_proxy baca-baca-1:8080 {
        header_up X-Forwarded-Proto {scheme}
            header_up X-Forwarded-Host {host}
            header_up X-Forwarded-For {remote_host}
            header_up X-Real-IP {remote_host}
        }
}
```

Restart the Caddy container to apply the changes. Now, you should be able to access the app at `https://baca.qurantajwid.my`.

## Using CloudPanel

This app was deployed using [CloudPanel](https://www.cloudpanel.io/docs/v2/getting-started/) on a VPS previously, before I moved to using [Docker](#using-docker). The top level steps are as follows:

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

For updating the app, you can see the github actions workflow file [here](../.github/workflows/deploy_prod.yml) and the update script [`deploy.sh`](../scripts/deploy.sh). Those files are no longer used by me, but I am keeping them here for reference.
