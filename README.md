# Laravel Docker Project - Clearit Test

This project is a Laravel application running with Docker using MySQL, Nginx, and phpMyAdmin. It is structured for local development and testing.

---

## 🐳 Requirements

- Docker
- Docker Compose

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

---

## 🌐 Access URLs

- Laravel app: [http://localhost:8000](http://localhost:8000)
- phpMyAdmin: [http://localhost:8080](http://localhost:8080)  
  (User: `root` / Password: `root` or `laravel` if you log in as user)

---

## 📌 Notes

- Make sure ports **8000** and **8080** are open on your local machine.
- The MySQL data is persisted in the `db/` directory (bind-mounted volume).
- Do **not** commit the `.env` file or `db/` folder to the repository.

---

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

Let me know if you want to add custom setup commands or extra services like Redis or Mailhog.
