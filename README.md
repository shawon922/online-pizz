# ![Laravel Online Shop]

A simple online shop with minimal features.

# UI REPO
  https://github.com/shawon922/online-pizz-ui.git

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/7.x/installation)


Clone the repository

    git clone https://github.com/shawon922/online-pizz.git

Switch to the repo folder

    cd online-pizz

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone https://github.com/shawon922/online-pizz.git
    cd online-pizz
    composer install
    cp .env.example .env
    php artisan key:generate
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding

**Populate the database with seed data which includes products. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh


# Code overview

## Folders

- `app/Models` - Contains all the Eloquent models
- `app/Http/Controllers/Api` - Contains all the api controllers
- `app/Http/Middleware` - Contains the middleware
- `app/Http/Requests` - Contains all the api form requestsrequests
- `config` - Contains all the application configuration files
- `database/factories` - Contains the model factory for all the models
- `database/migrations` - Contains all the database migrations
- `database/seeds` - Contains the database seeder
- `routes` - Contains all the api routes defined in api.php file


## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

# Testing API

Run the laravel development server

    php artisan serve

The api can now be accessed at

    http://localhost:8000/api


## Endpoints

- GET  `/products` - Get product list
- POST `/products` - Create new product
- GET  `/products/{product-slug}` - Get product details

- GET  `/carts` - Get cart products list
- POST `/carts` - Add product to cart
- DELETE  `/carts/{cartId}` - remove cart item

- GET  `/orders` - Get order list
- POST `/orders` - Create new order

Request headers

| **Required** 	| **Key**              	| **Value**            	|
|----------	|------------------	|------------------	|
| Yes      	| Content-Type     	| application/json 	|
| Yes      	| Accept 	        | application/json  |
| No      	| Currency-Type     | USD or EUR        |


----------
 
# Authentication
 
Authentication not implemented yet.

----------

# Cross-Origin Resource Sharing (CORS)
 
This applications has CORS disabled by default. The CORS allowed origins can be changed by modifying `app/Http/Middleware/CorsMiddleware.php`. Please check the following sources to learn more about CORS.
 
- https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS
- https://en.wikipedia.org/wiki/Cross-origin_resource_sharing
- https://www.w3.org/TR/cors