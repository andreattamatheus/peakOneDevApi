# Laravel API Project

## Overview

This project is a Laravel-based API with endpoints for managing email records. It includes functionality for creating, reading, updating, and deleting email records, as well as parsing raw email content. The API requires authentication for access.

## Table of Contents

-   [Requirements](#requirements)
-   [Installation](#installation)
-   [Configuration](#configuration)
-   [Running the Application](#running-the-application)
-   [API Endpoints](#api-endpoints)
-   [Authentication](#authentication)

## Requirements

-   PHP 8.1 or higher
-   Composer
-   MySQL
-   Node.js and npm (for frontend assets)

## Installation

**Clone the Repository**

```bash
git clone https://github.com/andreattamatheus/peakOneDevApi
cd your-project
```

## Project API

Copy the .env-example and rename it to .env

Inside the .env file, you must filled the correct info about your DB.

-   DB_HOST=127.0.0.1
-   DB_PORT=3306
-   DB_DATABASE=YOUR_DATABASE
-   DB_USERNAME=YOUR_USERNAME
-   DB_PASSWORD=YOUR_PASSWORD

```
composer install
```

```
php artisan optimize
```

Two users will be created here: backoffice@yopmail.com and admin@yopmail.com. Both have the password _123123123_

```
php artisan migrate:fresh --seed
```

```
php artisan serve
```

### Pint

```
 ./vendor/bin/pint
```

### PHPStan

```
 ./vendor/bin/phpstan analyse
```

### Test

```
php artisan test
```

### Delete job

You can check the schedules jobs:

```
php artisan schedule:list
```

If you want to run the command to parse the content, you can try:

```
php artisan email:parse
```

Then run:

```
php artisan queue:listen
```

## API Endpoints

### Create user

-   URL: /register
-   Method: POST
-   Headers: Content-Type: multipart/form-data
-   Description: Creates a new user

### Login user

-   URL: /login
-   Method: POST
-   Headers: Authorization: Bearer {token}, Content-Type: multipart/form-data
-   Description: Login a user

### Store a New Record

-   URL: /api/v1/emails
-   Method: POST
-   Headers: Authorization: Bearer {token}, Content-Type: multipart/form-data
-   Description: Creates a new record and parses the raw email content.

### Get Record by ID

-   URL: /api/v1/emails/{emailId}
-   Method: GET
-   Headers: Authorization: Bearer {token}
-   Description: Fetches a single record by its ID.

### Update a Record

-   URL: /api/v1/emails/{emailId}
-   Method: PUT
-   Headers: Authorization: Bearer {token}, Content-Type: application/json
-   Description: Updates a record by its ID.

### Get All Records

-   URL: /api/v1/emails
-   Method: GET
-   Headers: Authorization: Bearer {token}
-   Description: Returns all records, excluding deleted items. Pagination is optional.

### Delete a Record by ID

-   URL: /api/v1/emails/{emailId}
-   Method: DELETE
-   Headers: Authorization: Bearer {token}
-   Description: Soft deletes a record by its ID.

## Authentication

### Generating a Token

You need to generate a token to authenticate API requests. Use Laravel’s built-in authentication features or a package like Passport to manage tokens.

### Making Authenticated Requests

Include the token in the Authorization header of your requests:

Authorization: Bearer {your_token}

```
4|FtA7npeqHV6pA926caMyK62V6KTu0xJaLphzfVUQ3550142d
```
