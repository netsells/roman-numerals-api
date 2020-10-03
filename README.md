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
