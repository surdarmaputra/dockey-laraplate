
# Dockey Laraplate

[![Build Status](https://travis-ci.org/sdarmaputra/dockey-laraplate.svg?branch=master)](https://travis-ci.org/sdarmaputra/dockey-laraplate)

Simple Laravel project starter using [Laravel 5.4](https://laravel.com/docs/5.4). *Planning to provide support for latest Laravel version soon :)*.

### What's included?

Here are some stuff included in [Dockey Laraplate](https://github.com/sdarmaputra/dockey-laraplate):

- [docker compose](https://docs.docker.com/compose) configuration for development purpose which creates two services (nginx and php-fpm) in a single command
- [laravelcollective/html](https://laravelcollective.com/docs/5.3/html) for generating html element with some magic features inside blade template
- [doctrine/dbal](https://packagist.org/packages/doctrine/dbal) for supporting some features in database migration
- [ramsey/uuid](https://packagist.org/packages/ramsey/uuid) for generating UUID as our data identifier
- [santigarcor/laratrust](https://github.com/santigarcor/laratrust) for role management
- [Adminator Admin Dashboard](https://github.com/puikinsh/Adminator-admin-dashboard)
- [Swagger UI](https://swagger.io/swagger-ui/)
- bower support

#### Basic Features

Commonly used features included:

- Basic authentication
- User, role, and permission management
- Basic user, role, and permission seeder
- Basic API samples
- Basic API documentation
- Basic Firebase Push Notification sample
- Basic SMS Notification sample


### Quick start

- Download or clone the repository: `git clone https://github.com/sdarmaputra/dockey-laraplate.git`
- Go to dockey-laraplate directory
- Make a copy of .env.example to .env
- Set database configuration inside `.env` file
- Run `composer install`
- Run `composer initiate`
- Change some parts in file `compose/webserver/webserver.dockerfile` which labeled as `<your-user-name>` into your current user to tell nginx service to authorize your user as the owner of web server directory inside docker container
- Change some parts in file `compose/phpfpm/phpfpm.dockerfile` which labeled as `<your-user-name>` into your current user to tell php-fpm service to authorize your user as the owner of php-fpm application directory inside docker container
- Change some parts in file `compose/phpfpm/www.conf` which labeled as `<your-user-name>` into your current user to make php-fpm configuration sets your user as authorized user to run php-fpm
- Make sure you have installed [Docker](https://docs.docker.com/engine/installation) inside your current running system. Please check [Docker's official documentation](https://docs.docker.com/engine/installation/) for more information about Docker installation.
- Make sure you have installed [Docker Compose](https://docs.docker.com/compose). Please check [Docker Compose's official documentation](https://docs.docker.com/compose/install) for more information about Docker Compose installation.
- Run `docker-compose up` inside dockey-laraplate directory to bring up all of the services, or use `docker-compose -d` option to make docker compose run in background. Feel free to run `docker-compose help` to see available commands.
- Open your lovely browser and go to `localhost:21000`.
- Start to code and build something wowsome.

### Basic Authentication

It uses Laravel default authentication mechanism, including login, logout, register, and password reset.

### User, Role, and Permission management

Thanks to [santigarcor/laratrust](https://github.com/santigarcor/laratrust) package for providing use an easy to us role management. We add additional feature like `built-in` flag for user, role and permission so they can not be deleted by any user of the application.

We also provide basic users, roles, and permission seeder to quick start your application development :smile:.

### Basic API Samples

We provide basic API endpoint using two different format.

1. The first one is bare response, which is an API that response with exactly the same data without wrapping it inside some kind of commonly used message.
2. The second one is encapsulated response, which is an API that response with certain format for all cases. This is possible by providing `App\Http\ApiResponder` trait to wrap our API responses before it sends them to the client.

Basic tests for those API endpoints also available inside `tests/Feature/Api/V1` directory. We also create some helpers to shorten your assertion process for common scenario e.g. success response, unauthorized and unavailable entity.

### Basic Notification

There are 2 commonly used notifications if we built a back-end service for mobile applications, such as:

1. Firebase Push Notification
2. SMS Notification

We also created custom classes to support those notification located in `app/ThirdParties` directory.

#### Firebase Push Notification

For this scenario, we do several steps, including:

1. Save certain notification into database before sending it using Firebase Service
2. Send that notification using Firebase
3. Store Firebase service result into corresponding notification, so we can debug it easily if something went wrong

To support this scenario basically our Firbase Notification class use `database` notification and Firebase notification simultaniously.

#### SMS Notification

SMS Notification commonly used for sending OTP or reminders. For this scenario, we do several steps, including:

1. Save certain notification into database before sending it using SMS Gateway Service
2. Send that notification using SMS Gateway
3. Store sending process result into corresponding notification, so we can debug it easily if something went wrong

To support this scenario basically our SMS Notification class use `database` notification and SMS notification simultaniously.

*Note: Currently, we only support SMS Notification using limited SMS Gateway Provider for target audiences in Indonesia*

### Docker Compose

Dockey Laraplate provides `docker-compose.yml` which contains set of configuration for bringing up services to serve our Laravel project. For more informations about how to use Docker Compose please refer to [https://docs.docker.com/compose](https://docs.docker.com/compose). Inside this configuration file there are two services, nginx and php7-fpm. 

##### Nginx

- Dockerfile for nginx placed in `compose/webserver/webserver.dockerfile` file.
- `compose/webserver/dockey.conf` provides virtual host configuration for Laravel project.
- `compose/webserver/nginx.conf` provides general host configuration for nginx.

##### PHP-fpm

- Dockerfile for php-fpm placed in `compose/phpfpm/phpfpm.dockerfile` file.
- `compose/phpfpm/www.conf` provides configuration for php-fpm.

Feel free to overwrite those configuration files as you need. For a quick start, you just need to change all `<your-user-name>` label inside configuration files and Dockerfiles to have a smooth start.

Thanks for making it works and usefull :).

### Bower

[Bower](https://bower.io) is a good tool to maintain our project assets. Bower.json file have been generated with empty project dependency. All of bower components will be placed inside `public/supports` directory as defined in .bowerrc file.


## License

Dockey Laraplate is open-sourced and licensed under the [MIT license](http://opensource.org/licenses/MIT).
