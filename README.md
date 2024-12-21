<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel 11 Sanctum API with Breeze Frontend

This repository contains a Laravel 11 application featuring a Sanctum-based API for authentication and product management, along with a Breeze-powered frontend. Below are the key features and setup instructions. To do the peoject from scratch <a href="INSTALL.md"> docs</a> for more info.

## Features

### Authentication

-   **Login**
-   **Logout**
-   **Email Verification**
-   Built-in API authentication using Sanctum (requires API tokens for accessing and manipulating product data).

### Product Management

-   **Add Product**
-   **Delete Product**
-   **Edit Product**
-   **View Product**
-   Only the users who created a product can manipulate its data.

### Frontend

-   Built using [Laravel Breeze](https://laravel.com/docs/11.x/starter-kits#breeze) for a simple and elegant user interface.

## Prerequisites

Before you begin, ensure you have the following installed on your system:

-   PHP >= 8.2
-   Composer
-   Node.js and npm
-   MySQL or any other supported database | SQLite

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/KevinThulnith/Laravel-project.git
    cd Laravel-project
    ```

2. Install PHP dependencies:

    ```bash
    composer install
    ```

3. Install JavaScript dependencies:

    ```bash
    npm install && npm run dev
    ```

4. Set up your environment file:

    ```bash
    cp .env.example .env
    ```

    Update the `.env` file with your database credentials and other necessary configuration.

5. Generate the application key:

    ```bash
    php artisan key:generate
    ```

6. Run database migrations:

    ```bash
    php artisan migrate
    ```

7. Seed initial data (if any):

    ```bash
    php artisan db:seed
    ```

8. Serve the application:
    ```bash
    php artisan serve
    ```
    The application will be available at `http://localhost:8000`.

## API Endpoints

### Authentication

-   **Login:** `POST /api/login`
-   **Logout:** `POST /api/logout`
-   **Email Verification:** `POST /api/email/verify`

### Product Management

-   **Add Product:** `POST /api/products`
-   **Delete Product:** `DELETE /api/products/{id}`
-   **Edit Product:** `PUT /api/products/{id}`
-   **View Products:** `GET /api/products`

### Notes:

-   All product manipulation endpoints require an API token.
-   Only the user who created a product can edit or delete it.

## Frontend

The frontend is built using Laravel Breeze, providing:

-   Authentication pages (login, registration, password reset, email verification).
-   Basic product management UI integrated with the backend API.

## Testing

Run the test suite to ensure everything is working as expected:

```bash
php artisan test
```

## License

This project is open-source and available under the [MIT license](LICENSE).

---

Feel free to contribute and enhance the project! For questions or suggestions, open an issue or submit a pull request.
