# Dynamic Quiz System

A Laravel-based dynamic quiz platform supporting multiple question types, quiz attempts, automatic evaluation, result tracking, media uploads, and attempt history.

---

## Features

### Quiz Management

* Create quizzes
* View quizzes
* Delete quizzes

### Question Management

* Add questions dynamically
* Edit questions
* Delete questions
* Support for:

  * Binary questions
  * Single choice questions
  * Multiple choice questions
  * Numeric questions
  * Text questions

### Media Support

* Image upload support
* YouTube video URL support

### Quiz Attempt System

* Attempt quizzes
* Automatic answer evaluation
* Score calculation
* Percentage calculation
* Pass/Fail status

### Attempt History

* View previous quiz attempts
* Track scores and timestamps

### Dashboard

* Total quizzes
* Total questions
* Total attempts

---

## Tech Stack

* Laravel 13
* PHP 8.5
* MySQL
* Bootstrap 5
* jQuery
* Vite

---

## Installation

```bash
git clone <repository-url>

cd dynamic-quiz-system

composer install

npm install

cp .env.example .env

php artisan key:generate
```

---

## Database Setup

Update `.env` with MySQL credentials.

Run:

```bash
php artisan migrate:fresh --seed
```

---

## Run Project

### Start Laravel Server

```bash
php artisan serve
```

### Start Vite

```bash
npm run dev
```

---

## Demo Credentials

No authentication required.

---

## Author

Nilay Pandya
