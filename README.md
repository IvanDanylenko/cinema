## Cinema

Simple project made with laravel 10

-   Support authentication
-   Dashboard view
-   Movies CRUD

https://github.com/IvanDanylenko/cinema/assets/40359511/87c3e99a-41a4-4784-8fd8-d489b05b5143

## Setup

1. Install php dependencies
```
composer install
```

2. Copy `.env.example` into `.env`

3. Configure database connection

4. Run migrations and seed database
```
php artisan migrate --seed
```

5. Install javascript dependencies
```
# You must have node installed
npm install
```

6. To start project, run those commands in separate terminals
```
npm run dev
php artisan serve
```
