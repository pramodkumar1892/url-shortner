<h1 align="center">URL Shortening Service</h1>

## About URL Shortening Service

URL shortening service provide the following mechanisms:

- Shorten a URL
- Fetch full URL with respect to the Short URL
- Fetch hits count on the Short URL

#Steps to start the service
Fork this repository, then clone your fork, and run this in your newly created directory:

``` bash
composer install
```

Next you need to make a copy of the `.env.example` file and rename it to `.env` inside your project root.

Run the database migrations (Set the database connection in .env before migrating)

```
php artisan migrate
```

Then start your server:

```
php artisan serve
```
You can now access the server at http://localhost:8000


# API endpoints
## Create Short URL
[POST] http://example.com/short

###Parameters

|          Name | Required |  Type   | Description                                                                                                                                                           |
| -------------:|:--------:|:-------:| ---------------|
|     `link` | required | URL  |  A valid URL that needs to be shortened. Example: http://domain.com                                                                |
   

## Get Full URL
[GET] http://example.com/short/[short URL code]

## Get Hits on Short URL
[GET] http://example.com/hits/[short URL code]

