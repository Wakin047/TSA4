# Tasks for Today

Tasks for Today is a Laravel task-management application based on the TFA8 project. Anyone can view the task list, public profile, and About page. Signing in is required to create, edit, or archive tasks.

## Requirements

- PHP 8.2 or newer
- Composer
- XAMPP with MySQL/MariaDB (or another Laravel-supported database)

## Local setup

1. Install PHP dependencies:

   ```powershell
   composer install
   ```

2. Copy `.env.example` to `.env`, then set the application key:

   ```powershell
   Copy-Item .env.example .env
   php artisan key:generate
   ```

3. Start MySQL in XAMPP, open `http://localhost/phpmyadmin`, and create a database named `tsa4_tasks`. In `.env`, use:

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=tsa4_tasks
   DB_USERNAME=root
   DB_PASSWORD=
   ```

   Set `DB_USERNAME` and `DB_PASSWORD` to match your local MySQL account if they differ.

4. Run migrations and load the example tasks:

   ```powershell
   php artisan migrate
   php artisan db:seed
   ```

5. Start the development server:

   ```powershell
   php artisan serve
   ```

   Open `http://127.0.0.1:8000`.

Register an account to manage tasks. The task list is public; task creation, editing, and archiving require authentication.

## Completion email

The app sends a completion notification when an existing task changes from a status other than `done` to `done`. Re-saving a task already marked `done` does not send another message.

For local verification, use the `log` mail driver:

```dotenv
MAIL_MAILER=log
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_TASK_RECIPIENT="hello@example.com"
```

The generated message is written to `storage/logs/laravel.log`. To use SMTP instead, set `MAIL_MAILER=smtp` and configure `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, and `MAIL_PASSWORD` for a test SMTP service. Do not commit credentials.

## Tests

Run the feature tests with:

```powershell
php artisan test
```
