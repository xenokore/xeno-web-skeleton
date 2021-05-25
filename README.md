Xeno web-skeleton
=================

A skeleton project that can be used to create a Xeno based web application.

## Features

- Fully PSR compatible framework skeleton
- Includes:
    - **PHP-DI** as the main container
    - **Slim** for routing
    - **Doctrine** as object relation mapper and database abstraction layer
    - **Twig** for rendering
    - **PHPUnit** for unit testing
    - **PsySH** as REPL
    - **Symfony/Console** for console commands
- Everything is automatically dependency injected! (classes, controllers, console commands, Twig extensions, ...)
- Xeno components are automatically added to the App by simply including the library (cache, session, ...)

## Setup

1. Navigate to the parent directory where you want to create a new project and run the following command:

```
composer create-project xenokore/web-skeleton <project-name>
```

*The `project-name` argument will be the name of the created directory.*

2. Setup a webserver to serve files in the `/<project-name>/public` directory. Make sure to route every non-found file through `index.php`.
    An example **nginx** config can be found at `/<project-name>/docs/nginx.md`.

3. Startup your webserver and navigate to your newly created application. If everything works correctly you'll see the message: `The app is working correctly :^)`

## Usage

After setting up the project and webserver to use the framework, you can start creating your application by adding classes, views, controllers and routes. 
Have a look at the **Structure** part below to know where everything should go.

The app comes with a console that helps you with some basic tasks. You can access the console by simply running: `php ./console`. On unix systems you can simply do `./console`.

A few simple tasks are:
- `php ./console controller:create <name>` to create a new controller. The name should not be affixed with *"Controller"*
- `php ./console test:create <name>` to create a new unit test. The name should not be affixed with *"Test"*
- `php ./console cache:clear` to clear all cache files. This is useful in production after an update.

## Structure

`/app` contains the files used to structure your application. It contains:
- Container definitions
- The main bootstrap file as well as one for REPL
- Global middleware definitions
- Routes 

`/cache` contains the cache files for the application. Example:
- The compiled container
- The compiled routes
- Compiled Twig templates

`/config` contains configuration files to configure parts of the application that should not change between environments.

`/controllers` contains the controllers.

`/docs` for your app specific documentation.

`/i18n` is where *internationalization* files will be stored.

`/lib` is where non-composer libraries should be stored. An example would be the DataTables php files.

`/logs` is where the log files are stored.

`/migrations` is where Doctrine database migrations are stored. The migrations in the main directory are ignored by Git to help you during development. Everything in `/migrations/production` is committed however.

`/public` is the only directory that should be accessible by the webserver. Every request which does not correspond to an existing file in this directory is routed through `index.php`, which sets up the router. (Your *favicon* would go here for example.)

`/src` is the main directory for your application code. Everything here is namespaced under `\App` and is automatically dependency injected. Adding a custom container definition for a class will overwrite the default autowire behavior. 

`/tests` is where the PHPUnit tests are located. These are namespaced under `\App\Tests`.

`/uploads` is where user uploaded files will reside. The files in here are ignored by Git.

`/views` is the main views directory for Twig templates.

### Todo

- Add Whoops error handler.
- Maybe move some code from the web-skeleton to xenokore/app or other components
- More documentation
