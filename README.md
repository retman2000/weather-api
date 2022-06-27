# Weather API Authorization Demo

It's a simple demonstration of creating an authorization workflow for accessing a RESTful API.
The demo code can be reviewed [here](https://github.com/retman2000/weather-api).
It includes a LEMP environment comprised of a network of docker containers for local CodeIgniter development.

## Required Technologies
- **[Docker Desktop](https://docs.docker.com/desktop/)**
- **[Git](https://git-scm.com/downloads)**

## Setup
To get started, make sure you have [Docker installed](https://docs.docker.com/desktop/) on your system, then clone 
[this repository](https://github.com/retman2000/weather-api) by running `git clone https://github.com/retman2000/weather-api.git`
to a local directory on your system.
If you don't have Git installed, get it from [here](https://git-scm.com/downloads).

Next, navigate in your terminal to the directory you cloned this to and spin up the containers
for the web server by running `docker-compose up -d --build`. The build will take a few minutes to complete.

The following services are built for our web server, with their respective ports detailed.

- **nginx** - `:80`
- **mysql** - `:3306`
- **php** - `:9000`

## Very Important
Copy `env.dist` to `.env`

By default, the baseURL is `http://localhost/` and the default database is already set.

## Test Setup
Once the environment is up and running, open browser to [localhost](http://localhost). If the CodeIgniter
Welcome page is shown, the server is successfully running. To test the API navigate to
[http://localhost/api/weather/office/forecast](http://localhost/api/weather/office/forecast) in the browser.
The page should return a 401 status message in JSON format.

## Usage
To quickly test the endpoint, you can use an API platform like [Postman](https://www.postman.com/). Using Postman (or your favorite API tool),
send an HTTP GET request to the endpoint [http://localhost/api/weather/office/forecast](http://localhost/api/weather/office/forecast).
The request should return a 401 status message in JSON format.

Add `Api-Token` as an additional header key and use one of the two tokens, given in the original assignment instructions,
as the value. Send another HTTP GET request to the endpoint above. The response should contain an array of forecast days
in JSON format.

## MySQL Credentials
- **hostname** : localhost
- **database** : myapi
- **username** : root
- **password** : Password123!

## Utility Tool
- **To Reset MySQL data** : `bash reset-db.sh`
- **Remove weather-api image** : `docker rmi weather-api_php_fpm`