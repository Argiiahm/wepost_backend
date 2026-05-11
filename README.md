# wepost backend

Backend REST API for wepost social media application built with Laravel.

Repository: https://github.com/Argiiahm/wepost_backend.git

---

## Features

- Authentication
    - Register
    - Login
    - Logout
    - Current authenticated user

- Posts
    - Get all posts
    - Get single post
    - Create post
    - Update post
    - Delete post

- Protected API routes using Laravel Sanctum

- RESTful API architecture

---

## Tech Stack

- Laravel
- MySQL
- Laravel Sanctum
- REST API

---

## Clone Project

```bash
git clone https://://github.com/Argiiahm/wepost_backend.git
```

Move into project folder:

```bash
cd wepost_backend
```

---

## Installation

Install dependencies:

```bash
composer install
```

Copy `.env` file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

---

## Database Setup

Create database:

```sql
CREATE DATABASE wepost;
```

Configure `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wepost
DB_USERNAME=root
DB_PASSWORD=
```

Run migration:

```bash
php artisan migrate
```

---

## Run Server

```bash
php artisan serve
```

Server:

```txt
http://127.0.0.1:8000
```

---

## API Routes

### Public Routes

| Method | Endpoint         | Description     |
| ------ | ---------------- | --------------- |
| POST   | `/api/register`  | Register user   |
| POST   | `/api/login`     | Login user      |
| GET    | `/api/posts`     | Get all posts   |
| GET    | `/api/post/{id}` | Get single post |

---

### Protected Routes

Require Bearer Token authentication.

| Method | Endpoint         | Description            |
| ------ | ---------------- | ---------------------- |
| GET    | `/api/me`        | Get authenticated user |
| POST   | `/api/logout`    | Logout user            |
| POST   | `/api/post`      | Create post            |
| PUT    | `/api/post/{id}` | Update post            |
| DELETE | `/api/post/{id}` | Delete post            |

---

## Authentication

This project uses Laravel Sanctum for API authentication.

Example Authorization Header:

```txt
Authorization: Bearer your_token
```

---

## Project Structure

```bash
app/
├── Http/
│   └── Controllers/
│       ├── AuthController.php
│       └── PostController.php
├── Models/
└── Providers/
```

---

## Frontend Repository

https://github.com/Argiiahm/wepost_frontend

---

## Author

Argi
Made with EluniveID
