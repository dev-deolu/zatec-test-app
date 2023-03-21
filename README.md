
## Requirements

The following tools are required in order to start the installation.

- PHP >=8.1
- [Composer](https://getcomposer.org/download/)
- [NPM](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm)

## Installation

> Note that your database setup needs to be configured in your .env file
> Note to test the scheduler set, kindly create new terminal, navigate to this application root, then run php artisan schedule:work

1. Clone this repository with `git clone https://dev-deolu@bitbucket.org/dev-deolu/zatec-test-app.git`
2. Run `composer install` to install the PHP dependencies
3. Set up a local database called `laravel`
4. Run `composer setup` to setup the application
7. Configure the (optional) features from below


## Commands

Command | Description
--- | ---
**`php artisan test `** | Run the tests


## Google Login Setup
Please setup your credentials on goolge and include your test email
You can now visit the app in your browser by visiting [https://medium.com/employbl/add-login-with-google-to-your-laravel-app-d2205f01b895](Login With Google).

## Security Vulnerabilities

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## License

The MIT License. Please see [the license file](LICENSE.md) for more information.

