# E-commerce Store

A modern Laravel e-commerce storefront with a customer shopping flow and an admin dashboard for managing products, categories, and orders.

## Overview

This project is a complete e-commerce website built with Laravel and Blade templates. It includes:

- Public storefront with product listings and search
- Category and price filtering
- Shopping cart and checkout flow
- Order tracking and PDF invoice downloads
- Admin panel for products, categories, and order management
- Manual password reset flow

## Features

### Customer features

- Browse products by category and keyword
- Filter by minimum and maximum price
- View detailed product pages
- Add items to cart
- Update cart quantities and remove items
- Complete checkout while authenticated
- View past orders and download invoices

### Admin features

- Dashboard with totals for products, orders, and users
- Manage product catalog
- Create and edit product categories
- Upload and remove product images
- Update order status

## Tech stack

- PHP 8.2
- Laravel 12
- MySQL / SQLite support via Laravel database config
- Bootstrap 5
- Vite for front-end asset bundling
- DOMPDF for invoice generation
- QR code support via chillerlan/php-qrcode

## Project structure

```text
app/
  Http/Controllers/
  Http/Middleware/
  Models/
config/
database/
  migrations/
  seeders/
public/
resources/
  css/
  js/
  views/
routes/
artisan
composer.json
package.json
vite.config.js
```

## Requirements

Before running the application, make sure you have:

- PHP 8.2+
- Composer
- Node.js and npm
- A database server or SQLite support enabled

## Getting started

1. Clone the repository

```bash
git clone https://github.com/MOHSINEDAHNAOUI/shendy-ecommerce.git
cd ecommerce-site
```

2. Install PHP dependencies

```bash
composer install
```

3. Install front-end dependencies

```bash
npm install
```

4. Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

5. Run database migrations

```bash
php artisan migrate
```

6. Seed the admin user

```bash
php artisan db:seed --class=AdminSeeder
```

7. Start the app

```bash
php artisan serve
```

In another terminal, run:

```bash
npm run dev
```

Then open:

```text
http://localhost:8000
```

## Admin login

The seeded admin account is:

- Email: admin@ecommerce.com
- Password: admin123

Use it to access the admin panel at:

```text
http://localhost:8000/admin
```

## Useful commands

```bash
php artisan migrate
php artisan db:seed
php artisan test
npm run build
```

## License

This project is open-source and available under the MIT License.

## Notes

This application is designed as a learning or starter e-commerce project and can be extended with features such as coupons, product reviews, payment gateways, and user roles.