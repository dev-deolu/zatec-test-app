
## Requirements

The following tools are required in order to start the installation.

- PHP >=8.1
- [Docker](https://www.docker.com/)
- [Composer](https://getcomposer.org/download/)

> Please make sure you have docker running, you can verify using docker ps

> Please make sure PORT 3306 is available else set FORWARD_DB_PORT in your env

## Installation
1. Clone this repository with `git clone https://dev-deolu@bitbucket.org/dev-deolu/zatec-test-app.git ./coding-test-zatec`
2. In your terminal `cd ./coding-test-zatec`
3. Run `composer setup` to setup the application
> Note that your database setup needs to be configured in your .env file

## Required env credentials to be set

Command | How to
--- | ---
**`GOOGLE_CLIENT_ID `** | Check **Google Login Setup**
**`GOOGLE_CLIENT_SECRET `** | Check **Google Login Setup**
**`LAST_FM_KEY `** | Check **LastFM Setup**
**`LAST_FM_SECRET `** | Check **LastFM Setup**

## Google Login Setup
Please setup your credentials on goolge and include your test email
You can visit [https://medium.com/employbl/add-login-with-google-to-your-laravel-app-d2205f01b895](Login With Google).

## LastFM Setup
Please setup your credentials on lastfm 
You can visit [https://www.last.fm/api](LastFm).


