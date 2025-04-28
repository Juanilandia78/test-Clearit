# Laravel Docker Project - Clearit Test

This project is a Laravel application running with Docker using MySQL, Nginx, and phpMyAdmin.

**Ticket Management System**
A complete Laravel-based ticket management system designed to connect users and agents efficiently, featuring authentication, ticket workflows, documentation exchange, and basic notifications.

---

## 🐳 Requirements

- Docker
- Docker Compose
- Git
- GitHub account (to clone the repository)

---

## 🚀 Getting Started

1. **Clone the repository**

```bash
git clone https://github.com/Juanilandia78/test-Clearit.git
cd test-Clearit
```

2. **Create your `.env` file**

Copy the example `.env` and update the following variables (if not already present):

```bash
cp app/.env.example app/.env
```

Inside `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret

# Add these if missing
BROADCAST_DRIVER=log
NOTIFICATION_DRIVER=database
```

3. **Start the containers**

```bash
docker-compose up -d --build
```

4. **Install PHP dependencies**

```bash
docker exec -it laravel_app composer install
```

5. **Generate the application key**

```bash
docker exec -it laravel_app php artisan key:generate
```

6. **Run migrations**

```bash
docker exec -it laravel_app php artisan migrate
```

Additional Setup Steps

**Populate the database with test data:**

```bash
docker exec -it laravel_app php artisan db:seed
```

**Storage Link**
After generating the app key, create the symbolic link for Laravel storage:

```bash
docker exec -it laravel_app  php artisan storage:link
```
*This is necessary for the application to serve files (such as profile images or attachments) stored in storage/app/public.*


**If there are permission errors:**

```bash
docker exec -it laravel_app sh -c "chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache && chmod -R 775 /var/www/storage"
```


## Frontend Assets (Vite)

If you see style errors or "Vite manifest not found":

1. Install npm inside the app container (only needed once):

```bash
docker exec -it laravel_app apk add --no-cache npm
```

2. Build assets (production):
```bash
docker exec -it laravel_app npm install && npm run build
```


---

## 🌐 Access URLs

- Laravel app: [http://localhost:3000](http://localhost:3000)
- phpMyAdmin: [http://localhost:3002](http://localhost:3002)  
  (User: `root` / Password: `root` or `laravel` if you log in as user)

LOGIN:
User Access:

Email: user@example.com
Password: password

Agent Access:

Email: agent@example.com
Password: password

---

## 📌 Notes

- Make sure ports **3000** and **3002** are open on your local machine.
- The MySQL data is persisted in the `db/` directory (bind-mounted volume).
- Do **not** commit the `.env` file or `db/` folder to the repository.

---

## Features

User and Agent authentication (separate roles).

Ticket management system with multiple attributes and status tracking.

Secure document exchange within tickets.

Basic notification system for ticket updates.


## 🛑 .gitignore Highlights

Ensure your `.gitignore` includes:

```gitignore
# Ignore database files
/db

# Ignore Laravel app storage and environment files
app/vendor
app/node_modules
app/.env
app/storage/*.key
```

---


