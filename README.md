
## Requirements

The following tools are required in order to start the installation.

- [Docker](https://www.docker.com/)
- [Composer](https://getcomposer.org/download/)

> Please make sure you have docker running, you can verify using `docker ps`

> Please make sure `PORT 3306` is available else set `FORWARD_DB_PORT` in your env

## Installation
1. Clone this repository with `git clone https://dev-deolu@bitbucket.org/dev-deolu/zatec-test-app.git ./zatec-test-app`
2. In your terminal `cd ./zatec-test-app`
3. Run `nano .env` to add values **required ENV credentials** OR Use your code editor to set **required ENV credentials** in .env file
4. Run `composer setup` to setup the application and move into docker container
5. Run `composer build` to build the application
> Note that your required env credentials needs to be set for full functionality.

## Required ENV Credentials

Command | How to
--- | ---
**`GOOGLE_CLIENT_ID `** | Check **Google Login Setup**
**`GOOGLE_CLIENT_SECRET `** | Check **Google Login Setup**
**`LAST_FM_KEY `** | Check **LastFM Setup**
**`LAST_FM_SECRET `** | Check **LastFM Setup**

## Google Login Setup
Please setup your credentials on goolge and include your test email
You can visit [Login With Google](https://medium.com/employbl/add-login-with-google-to-your-laravel-app-d2205f01b895).
## LastFM Setup
Please setup your credentials on lastfm 
You can visit [LastFm](https://www.last.fm/api).

## Test Application
You can visit [APP URL](http://localhost:7060).

