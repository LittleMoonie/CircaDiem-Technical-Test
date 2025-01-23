# Product Management Application

This is a technical test given by **Cercia Diem** as part of the selection process for an alternance opportunity.

## Project Description

The application is a simple **product management system** built with Laravel and SQLite. It allows users to:

- Manage products, including variations like size and color.
- Organize products into categories.
- Perform CRUD operations via a web interface built with **Tailwind CSS** or Artisan commands.
- Use SQLite as the database backend for simplicity and portability.

### Key Features

1. **Product Management**
 - Create, view, edit, and delete products.
 - Add product variations (e.g., sizes, colors) with optional price adjustments.
 - Display the total price (base price + variation prices).

2. **Category Management**
 - Create and manage product categories.
 - Associate products with categories (one-to-many).

3. **Command-Line Interface**
 - Artisan commands are available to perform CRUD operations on products, categories, and variations.

4. **SQLite Database**
 - No external database setup is required. The project uses an SQLite file for all data storage.

5. **Factory and Seeder**
 - Generate sample data using Laravel factories and seeders.

6. **Optional Bonus Features**
 - Pagination for product lists.
 - Search and filter by category.

---

## Requirements

To run this project, you need:

- PHP 8.0 or later
- Composer
- Node.js and npm
- SQLite (included by default in PHP)

---

## Installation

### 1. Clone the repository:
```bash
git clone https://github.com/yourusername/product-management-test.git
cd product-management-test
```

### 2\. Install PHP dependencies:

```bash
composer install
```

### 3\. Install JavaScript dependencies:

```bash
npm install
```

### 4\. Set up the `.env` file:

1.  Copy the example `.env` file:

    ```bash
    cp .env.example .env
    ```

2.  Edit the `.env` file to include the following configuration:

    ```env
    APP_NAME=ProductManagementApp
    APP_ENV=local
    APP_KEY=base64:GENERATE_USING_PHP_ARTISAN_KEY:GENERATE
    APP_DEBUG=true
    APP_URL=http://127.0.0.1:8000

    LOG_CHANNEL=stack
    LOG_LEVEL=debug

    DB_CONNECTION=sqlite
    DB_DATABASE=database/database.sqlite

    BROADCAST_DRIVER=log
    CACHE_DRIVER=file
    QUEUE_CONNECTION=sync
    SESSION_DRIVER=file
    SESSION_LIFETIME=120

    VITE_DEV_SERVER_URL=http://localhost:5173
    ```

3.  Generate an application key:

    ```bash
    php artisan key:generate
    ```

### 5\. Set up the database:

1.  Create the SQLite database file:

    ```bash
    touch database/database.sqlite
    ```

2.  Run migrations and seed the database:

    ```bash
    php artisan migrate --seed
    ```

### 6\. Build assets and run the application:

#### For development:

1.  Start the Vite development server:

    ```bash
    npm run dev
    ```

2.  Start the Laravel development server:

    ```bash
    php artisan serve
    ```

Visit the application at http://127.0.0.1:8000.

#### For production:

1.  Build assets:

    ```bash
    npm run build
    ```

* * * * *

## Artisan Commands
----------------

The following Artisan commands are available:

1.  **Manage Products**

    ```bash
    php artisan manage:products list|create|update|delete
    ```

2.  **Manage Categories**

    ```bash
    php artisan manage:categories list|create|update|delete
    ```

3.  **Manage Variations**

    ```bash
    php artisan manage:variations list|create|update|delete
    ```

* * * * *

## License
-------

This project is for technical assessment purposes only and is not licensed for public or commercial use.

* * * * *

## Author
------

Developed by Lazaro Marrero Rousse as part of the technical test for Cercia Diem.
