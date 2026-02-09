# InvoiceFlow - Freelancer Invoice & Client Management

A modern, full-featured invoice management system built from scratch with PHP 8.2+ using a custom MVC framework. Designed for freelancers and small businesses to manage invoices, clients, products, and track revenue.

## Features

- **Dashboard** - Business overview with revenue stats, invoice counts, and recent activity
- **Invoice Management** - Create, edit, send, and track invoices with multiple status (Draft, Pending, Paid, Overdue)
- **Client Management** - Full client database with contact details and invoice history
- **Products & Services** - Manage your offerings with pricing and units
- **Reports & Analytics** - Monthly revenue charts, status breakdown, and top clients
- **Authentication** - Secure login/register with password hashing
- **Modern UI** - Clean, responsive design built with Tailwind CSS
- **Custom MVC Framework** - Built entirely from scratch (no frameworks used)

## Tech Stack

- **PHP 8.2+** - Modern PHP with type hints and named arguments
- **MySQL / MariaDB** - Relational database with PDO
- **Tailwind CSS** - Utility-first CSS framework
- **Material Symbols** - Google's icon library
- **Custom MVC Architecture** - Router, Controllers, Models, Views, Middleware

## Architecture Highlights

- **Custom Router** - Support for GET/POST with dynamic parameters (`/invoices/{id}`)
- **ActiveRecord ORM** - Models with validation, CRUD operations, and relationships
- **Middleware System** - Authentication middleware for protected routes
- **Session Management** - Flash messages, CSRF protection
- **Database Migrations** - Version-controlled schema changes
- **Input Sanitization** - XSS protection with `htmlspecialchars()` escaping

## Requirements

- PHP 8.2 or higher
- MySQL / MariaDB
- Apache with mod_rewrite (or PHP built-in server)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/KHADIJALAH/invoiceflow.git
cd invoiceflow
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

6. Open http://localhost:8000 and register a new account

## Project Structure

```
invoiceflow/
├── app/
│   ├── Controllers/        # Request handlers
│   │   ├── AuthController.php
│   │   ├── ClientController.php
│   │   ├── DashboardController.php
│   │   ├── HomeController.php
│   │   ├── InvoiceController.php
│   │   ├── ProductController.php
│   │   └── ReportController.php
│   ├── Core/               # Framework engine
│   │   ├── Application.php
│   │   ├── Controller.php
│   │   ├── Database.php
│   │   ├── DbModel.php
│   │   ├── helpers.php
│   │   ├── Middleware.php
│   │   ├── Model.php
│   │   ├── Request.php
│   │   ├── Response.php
│   │   ├── Router.php
│   │   ├── Session.php
│   │   └── User.php
│   ├── Middleware/
│   │   └── AuthMiddleware.php
│   ├── Models/
│   │   ├── Client.php
│   │   ├── Invoice.php
│   │   ├── InvoiceItem.php
│   │   └── Product.php
│   └── Views/
│       ├── layouts/        # app.php (sidebar layout), auth.php
│       ├── auth/           # login, register, profile
│       ├── dashboard/      # main dashboard
│       ├── invoices/       # CRUD views + invoice detail
│       ├── clients/        # CRUD views + client detail
│       ├── products/       # CRUD views
│       ├── reports/        # analytics page
│       └── settings/       # account settings
├── config/
│   └── app.php             # Database & app configuration
├── database/
│   └── migrations/         # Schema migrations
├── public/
│   ├── index.php           # Entry point
│   └── .htaccess           # URL rewriting
├── routes/
│   └── web.php             # Route definitions
├── storage/                # Logs & uploads
└── migrate.php             # Migration runner
```

## Screenshots

### Dashboard
Modern dashboard with revenue metrics, invoice statistics, and recent invoices table.

### Invoice Detail
Professional invoice view with client info, line items, totals, and status management.

### Client Management
Client cards with contact info and linked invoice history.

## API Routes

| Method | Route | Description |
|--------|-------|-------------|
| GET | `/dashboard` | Main dashboard |
| GET | `/invoices` | List all invoices |
| GET | `/invoices/create` | New invoice form |
| POST | `/invoices` | Create invoice |
| GET | `/invoices/{id}` | Invoice detail |
| GET | `/invoices/{id}/edit` | Edit invoice form |
| POST | `/invoices/{id}` | Update invoice |
| POST | `/invoices/{id}/delete` | Delete invoice |
| POST | `/invoices/{id}/status` | Update status |
| GET | `/clients` | List clients |
| GET | `/clients/create` | Add client form |
| POST | `/clients` | Create client |
| GET | `/clients/{id}` | Client detail |
| GET | `/products` | List products |
| GET | `/products/create` | Add product form |
| GET | `/reports` | Analytics page |

## Author

**Khadija Lahlou**
- GitHub: [@KHADIJALAH](https://github.com/KHADIJALAH)
- LinkedIn: [Khadija Lahlou](https://www.linkedin.com/in/khadija-lahlou-48a8062b9)

## License

MIT License
