
# Dockey Laraplate

Simple laravel project boilerplate that supports docker compose for development environment. It uses [Laravel 5.4](https://laravel.com/docs/5.4).

### What's included?

Here are some stuff included in [Dockey Laraplate](https://github.com/sdarmaputra/dockey-laraplate):

- [docker compose](https://docs.docker.com/compose) configuration for development purpose which creates two services (nginx and php-fpm) in a single command
- [laravelcollective/html](https://laravelcollective.com/docs/5.3/html) for generating html element with some magic features inside blade template
- [doctrine/dbal](https://packagist.org/packages/doctrine/dbal) for supporting some features in database migration
- [ramsey/uuid](https://packagist.org/packages/ramsey/uuid) for generating UUID as our data identifier
- bower support

### Quick start

- Download or clone the repository: `git clone https://github.com/sdarmaputra/dockey-laraplate.git`
- Go to dockey-laraplate directory
- Make a copy of .env.example to .env
- Run `composer install`
- Run `php artisan key:generate`
- Change some parts in file compose/webserver/webserver.dockerfile which labeled as `<your-user-name>` into your current user to tell nginx service to authorize your user as the owner of web server directory inside docker container
- Change some parts in file compose/phpfpm/phpfpm.dockerfile which labeled as `<your-user-name>` into your current user to tell php-fpm service to authorize your user as the owner of php-fpm application directory inside docker container
- Change some parts in file compose/phpfpm/www.conf which labeled as `<your-user-name>` into your current user to make php-fpm configuration sets your user as authorized user to run php-fpm
- Make sure you have installed [Docker](https://docs.docker.com/engine/installation) inside your current running system. Please check [Docker's official documentation](https://docs.docker.com/engine/installation/) for more information about Docker installation.
- Make sure you have installed [Docker Compose](https://docs.docker.com/compose). Please check [Docker Compose's official documentation](https://docs.docker.com/compose/install) for more information about Docker Compose installation.
- Run `docker-compose up` inside dockey-laraplate directory to bring up all of the services, or use `docker-compose -d` option to make docker compose run in background. Feel free to run `docker-compose help` to see available commands.

### Docker Compose

Dockey Laraplate provides **docker-compose.yml** which contains set of configuration for bringing up services to serve our Laravel project. For more informations about how to use Docker Compose please refer to [https://docs.docker.com/compose](https://docs.docker.com/compose). Inside this configuration file there are two services, nginx and php7-fpm. 

##### Nginx

- Dockerfile for nginx placed in **compose/webserver/webserver.dockerfile** file.
- **compose/webserver/dockey.conf** provides virtual host configuration for Laravel project.
- **compose/webserver/nginx.conf** provides general host configuration for nginx.

##### PHP-fpm

- Dockerfile for php-fpm placed in **compose/phpfpm/phpfpm.dockerfile** file.
- **compose/phpfpm/www.conf** provides configuration for php-fpm.

Feel free to overwrite those configuration files as you need. For a quick start, you just need to change all `<your-user-name>` label inside configuration files and Dockerfiles to have a smooth start.

Thanks for making it works and usefull :).
Feel free to send us feedback by email to *surya.igede[at]gmail.com*.

### Bower

[Bower](https://bower.io) is a good tool to maintain our project assets. Bower.json file have been generated with empty project dependency. All of bower components will be placed inside **public/supports** directory as defined in .bowerrc file.


## License

Dockey Laraplate is open-sourced and licensed under the [MIT license](http://opensource.org/licenses/MIT).