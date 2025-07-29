# Service Booking System

A RESTful PHP backend for a Service Booking system.

## Features

- User Authentication (Register, Login,Profile, Logout)
- User Type(Admin and Customer roles)
- Service management
- Booking management with status Update by admin
- JSON API responses

## Technologies Used

- Laravel 12
- Sanctum for API authentication
- Eloquent ORM
- SQLite database (for simplicity, can be changed to MySQL/PostgreSQL)

## Setup Instructions

1. Clone the repository
2. Install dependencies:
   ```bash
   composer install
   ```
3. Copy the .env.example file to .env:
   
4. Generate application key:
   ```bash
   php artisan key:generate
   ```
5. Set up the database in your .env file:
   ```
   DB_CONNECTION=sqlite
   DB_DATABASE=/absolute/path/to/database.sqlite
   ```
6. Create an empty SQLite database file:
   ```bash
   touch database/database.sqlite
   ```
7. Run migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```
8. Start the development server:
   ```bash
   php artisan serve
   ```

# Test User
   ## Admin
      -Email: admin@example.com
      -Pass : password
   ## User
      -Email: rahat@gmail.com
      -Pass : password

      -Email: ehsan@gmail.com
      -Pass : password

