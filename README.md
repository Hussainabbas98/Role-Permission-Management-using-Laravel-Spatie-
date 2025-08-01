# Laravel Role-Permission Product Management

A Laravel application demonstrating role and permission management using [spatie/laravel-permission](https://github.com/spatie/laravel-permission) for a simple Product CRUD system.

---

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Environment Setup](#environment-setup)
- [Database Migration & Seeding](#database-migration--seeding)
- [Frontend Assets](#frontend-assets)
- [Authentication Scaffolding](#authentication-scaffolding)
- [Role & Permission Setup](#role--permission-setup)
- [Product CRUD](#product-crud)
- [Artisan Commands](#artisan-commands)
- [Testing](#testing)
- [License](#license)

---

## Features

- User authentication (login/register)
- Role and permission management (using Spatie package)
- Product CRUD (Create, Read, Update, Delete)
- Middleware protection for product actions
- Bootstrap UI scaffolding

---

## Requirements

- PHP >= 8.1
- Composer
- Node.js & NPM
- SQLite/MySQL/PostgreSQL (default: SQLite for demo)
- Laravel 10+ (or as per your composer.json)

---

## Installation

Clone the repository:

```sh
git clone https://github.com/Hussainabbas98/Role-Permission-Management-using-Laravel-Spatie-.git
cd Role-Permission-Management-using-Laravel-Spatie
```

Install PHP dependencies:

```sh
composer install
```

Install Node dependencies:

```sh
npm install
```

---

## Environment Setup

Copy the example environment file and set your variables:

```sh
cp .env.example .env
```

Generate the application key:

```sh
php artisan key:generate
```

**SQLite (recommended for demo):**

```sh
touch database/database.sqlite
# In .env, set:
# DB_CONNECTION=sqlite
# DB_DATABASE=/absolute/path/to/database/database.sqlite
```

**MySQL/PostgreSQL:**  
Edit `.env` with your DB credentials.

---

## Database Migration & Seeding

Run migrations:

```sh
php artisan migrate
```

(Optional) Seed demo data:

```sh
php artisan db:seed
```

---

## Frontend Assets

Compile assets for development:

```sh
npm run dev
```

Or for production:

```sh
npm run build
```

---

## Authentication Scaffolding

Install Laravel UI and Bootstrap auth scaffolding:

```sh
composer require laravel/ui --dev
php artisan ui bootstrap --auth
npm install
npm run dev
```

---

## Role & Permission Setup

Install Spatie Laravel Permission:

```sh
composer require spatie/laravel-permission
```

Publish the config and migration:

```sh
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

Run migrations:

```sh
php artisan migrate
```

Add the `HasRoles` trait to your `User` model:

```php
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    // ...
}
```

Create roles and permissions (example via tinker):

```sh
php artisan tinker
```

```php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

$role1 = Role::create(['name' => 'writer']);
$role2 = Role::create(['name' => 'admin']);
$role3 = Role::create(['name' => 'Super-Admin']);

Permission::create(['name' => 'product-create']);
Permission::create(['name' => 'product-edit']);
Permission::create(['name' => 'product-delete']);

$role1->givePermissionTo('product-create');
$role2->givePermissionTo(['product-create', 'product-edit', 'product-delete']);
```

Assign roles to users:

```php
$user = \App\Models\User::find(1);
$user->assignRole('admin');
```

---

## Product CRUD

- All product actions are protected by permission middleware.
- Only users with the correct permissions can create, edit, or delete products.

**ProductController Middleware Example:**

```php
$this->middleware(['permission:product-create|product-edit|product-delete'], ['only' => ['index', 'show']]);
$this->middleware(['permission:product-create'], ['only' => ['create', 'store']]);
$this->middleware(['permission:product-edit'], ['only' => ['edit', 'update']]);
$this->middleware(['permission:product-delete'], ['only' => ['destroy']]);
```

---

## Artisan Commands

Common commands used in this project:

| Command | Description |
|---------|-------------|
| `php artisan migrate` | Run database migrations |
| `php artisan db:seed` | Seed the database |
| `php artisan serve` | Start the local server |
| `php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"` | Publish Spatie config/migrations |
| `php artisan make:model Product -m` | Create Product model and migration |
| `php artisan make:controller ProductController --resource` | Create resource controller |
| `php artisan route:list` | List all routes |
| `php artisan tinker` | Open Laravel Tinker for interactive shell |
| `php artisan cache:clear` | Clear application cache |
| `php artisan config:clear` | Clear config cache |
| `php artisan permission:cache-reset` | Reset Spatie permission cache |

---


