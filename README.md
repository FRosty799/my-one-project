# My One Project

A Laravel web application project.

## Requirements

- PHP 8.0+
- Composer
- Node.js & npm

## Installation

1. Clone the repository
```bash
git clone <repository-url>
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

## Running the Application

Start the development server:
```bash
php artisan serve
```

Visit `http://my-one-project.test/` in your browser.

## Project Structure

- `/app` - Application logic
- `/routes` - Route definitions
- `/resources` - Views and assets
- `/database` - Migrations and seeders
