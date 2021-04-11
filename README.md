# Solution
## Endpoints

### POST /api/v1/numerals
Convert a number to numeral and store.

Example request:
```json
{
    "number": 123
}
```

### GET /api/v1/numerals
Get a list of numerals and conversion counts, ordered by last converted at.

### GET /api/v1/numerals/top
Get the top 10 numerals ordered by the number of conversions.

### Running in Docker
I've added a basic Dockerfile and docker-compose.yml to this repo just to make setting up and running the code easier. I don't actually have PHP installed on my host as I generally work in containers so figured it was easier to spin up a container than install PHP, composer, etc...

While in the root of this project just run:
```shell
docker-compose up
```
And it'll install dependencies, create SQLite DB and start a server on http://127.0.0.1:8000 (or whatever your IP is).

If you're not using Docker, just do the standard Laravel project startup procedure, dependencies, copy .env, APP key, DB migrate

Tests can be run with:
```shell
docker exec roman_numerals_api php artisan test
```
# Roman Numerals API Task
This development task is based on the Roman Numeral code kata which may have already been completed during this recruitment process. This task requires you to build a JSON API and so any HTML, CSS or JavaScript that is submitted will not be reviewed.

## Brief
Our client (Numeral McNumberFace) requires a simple RESTful API which will convert an integer to its roman numeral counterpart. After our discussions with the client, we have discovered that the solution will contain three API endpoints, and will only support integers ranging from 1 to 3999. The client wishes to keep track of conversions so they can determine which is the most frequently converted integer, and the last time this was converted.

### Endpoints Required
 1. Accepts an integer, converts it to a roman numeral, stores it in the database and returns the response.
 2. Lists all the recently converted integers.
 3. Lists the top 10 converted integers.
 
## What we are looking for
 - Use of MVC components (View in this instance can be, for example, a Laravel Resource).
 - Use of [Fractal](https://fractal.thephpleague.com/) or [Laravel Resources](https://laravel.com/docs/8.x/eloquent-resources)
 - Use of Laravel features such as Eloquent, Requests, Validation and Routes.
 - An implementation of the supplied interface.
 - The supplied PHPUnit test passing.
 - Clean code, following PSR-12 standards.
 - Use of PHP 7.4 features where appropriate.
 
## Submission Instructions
Please create a [git bundle](https://git-scm.com/docs/git-bundle/) and send the file across:
```
git bundle create <yourname>.bundle --all --branches
```
