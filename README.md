# PHP MVC Framework

A lightweight, modern MVC framework built from scratch with PHP 8.2+. This project demonstrates core PHP concepts and software architecture skills.

## Features

- **Custom Router**: Support for GET, POST, PUT, DELETE with dynamic parameters
- **MVC Architecture**: Clean separation of Models, Views, and Controllers
- **Database ORM**: ActiveRecord-style models with PDO
- **Authentication**: Session-based auth with password hashing
- **Middleware**: Flexible middleware system for access control
- **Form Validation**: Comprehensive validation with custom rules
- **Flash Messages**: Session-based flash messaging
- **CSRF Protection**: Built-in CSRF token generation
- **Migrations**: Database migration system

## Requirements

- PHP 8.2 or higher
- MySQL / MariaDB
- Apache with mod_rewrite (or PHP built-in server)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/KHADIJALAH/php-mvc-framework.git
cd php-mvc-framework
```

2. Create the database:
```sql
CREATE DATABASE php_mvc_db;
```

3. Configure database in `config/app.php`:
```php
'db' => [
    'dsn' => 'mysql:host=localhost;port=3306;dbname=php_mvc_db',
    'user' => 'root',
    'password' => ''
]
```

4. Run migrations:
```bash
php migrate.php
```

5. Start the server:
```bash
cd public
php -S localhost:8000
```

6. Open http://localhost:8000 in your browser

## Project Structure

```
php-mvc-framework/
├── app/
│   ├── Controllers/     # Application controllers
│   ├── Core/           # Framework core classes
│   ├── Middleware/     # Custom middlewares
│   ├── Models/         # Database models
│   └── Views/          # View templates
│       ├── layouts/    # Layout templates
│       ├── home/       # Home pages
│       ├── auth/       # Auth pages
│       ├── dashboard/  # Dashboard pages
│       └── errors/     # Error pages
├── config/             # Configuration files
├── database/
│   └── migrations/     # Database migrations
├── public/             # Public files (entry point)
├── routes/             # Route definitions
├── storage/            # Logs and uploads
└── migrate.php         # Migration script
```

## Routing

Define routes in `routes/web.php`:

```php
$app->router->get('/', [HomeController::class, 'index']);
$app->router->post('/login', [AuthController::class, 'loginPost']);
$app->router->get('/user/{id}', [UserController::class, 'show']);
```

## Controllers

```php
class HomeController extends Controller
{
    public function index(Request $request, Response $response): string
    {
        return $this->renderWithLayout('home/index', [
            'title' => 'Welcome'
        ]);
    }
}
```

## Models

```php
class User extends DbModel
{
    public static function tableName(): string
    {
        return 'users';
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
        ];
    }
}
```

## Middlewares

```php
class AuthMiddleware extends Middleware
{
    public function execute(): void
    {
        if (Application::isGuest()) {
            Application::$app->response->redirect('/login');
        }
    }
}
```

## Technologies

- **PHP 8.2+**: Modern PHP features
- **PDO**: Secure database access
- **Tailwind CSS**: Utility-first CSS framework
- **Font Awesome**: Icon library

## Author

**Khadija Lahlou**
- GitHub: [@KHADIJALAH](https://github.com/KHADIJALAH)
- LinkedIn: [Khadija Lahlou](https://www.linkedin.com/in/khadija-lahlou-48a8062b9)

## License

MIT License - feel free to use this project for learning purposes.
