# My One Project

A Laravel web application project.

## Requirements

- PHP 8.0+
- Composer
- Node.js & npm

**OR** use [Laravel Herd](https://herd.laravel.com/) which includes PHP, Node.js, Composer, and other development tools pre-configured.

## Installation

### Option 1: Traditional Setup

1. Clone the repository
```bash
git clone https://github.com/FRosty799/my-one-project
cd my-one-project
```

2. Install PHP dependencies
```bash
composer install
```

3. Install JavaScript dependencies
```bash
npm install
```

In another terminal, compile assets:
```bash
npm run dev
```

5. Generate application key
```bash
php artisan key:generate
```

6. Run migrations
```bash
php artisan migrate
```

### Option 2: Using Laravel Herd

1. Install [Laravel Herd](https://herd.laravel.com/)
2. Clone the repository
```bash
git clone https://github.com/FRosty799/my-one-project
cd my-one-project
```

3. Install PHP dependencies
```bash
composer install
```

4. Install JavaScript dependencies
```bash
npm install
```

5. Generate application key
```bash
php artisan key:generate
```

6. Run migrations
```bash
php artisan migrate
```

## Running the Application

### Without Laravel Herd

Start the development server:
```bash
php artisan serve
```

Visit `http://my-one-project.test/` in your browser.

In another terminal, compile assets:
```bash
npm run dev
```

### With Laravel Herd

Laravel Herd automatically manages your local domain and development environment. Simply:

1. Start the application:
```bash
php artisan serve
```

2. In another terminal, compile assets:
```bash
npm run dev
```

3. Visit `http://my-one-project.test/` in your browser

Laravel Herd handles the web server setup automatically, so you don't need additional configuration.

## Project Structure

- `/app` - Application logic
- `/routes` - Route definitions
- `/resources` - Views and assets
- `/database` - Migrations and seeders

## Demo / Screenshot
