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

Additional Setup Steps

**Storage Link**
After generating the app key, create the symbolic link for Laravel storage:

```bash
docker exec -it laravel_app  php artisan storage:link
```
*This is necessary for the application to serve files (such as profile images or attachments) stored in storage/app/public.*


**Fixing Styles in Docker Container**
If styles are not loading correctly inside the Docker container, it might be because npm is not installed. To fix it:

Install npm inside the container (only once):

```bash
docker exec -it laravel_app sh
```

```bash
apk add npm
```
Then run the build process:

```bash
npm install && npm run build
```
This will compile TailwindCSS or any other frontend assets, depending on your configuration.


---

## 🌐 Access URLs

- Laravel app: [http://localhost](http://localhost:80)
- phpMyAdmin: [http://localhost:8080](http://localhost:8080)  
  (User: `root` / Password: `root` or `laravel` if you log in as user)

---

## 📌 Notes

- Make sure ports **80** and **8080** are open on your local machine.
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
