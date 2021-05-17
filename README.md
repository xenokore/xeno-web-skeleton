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
- Everything is automatically dependency injected! (App source, controllers, TwigExtensions)
- Xeno components are automatically added to the App by simply including the library (cache, session, ...)

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

`/logs` is where the log files are stored

`/migrations` is where Doctrine database migrations are stored. The migrations in the main directory are ignored by Git to help you during development. Everything in `/migrations/production` is committed however.

`/public` is the only directory that should be accessible by the webserver. Every request which does not correspond to an existing file in this directory is routed through `index.php`, which sets up the router. (Your *favicon* would go here for example.)

`/src` is the main directory for your application code. Everything here is namespaced under `\App` and is automatically dependency injected. Adding a custom container definition will overwrite this behavior. 

`/tests` is where the PHPUnit tests are located. These are namespaced under `\App\Tests`.

`/uploads` is where user uploaded files will reside. The files in here are ignored by Git.

`/views` is the main views directory for Twig templates.

``

### Todo

- Create a scripts to setup controllers and unit tests
- Include doctrine2
- Add Traits for easy access to the application during unit testing
- Add Whoops error handler
