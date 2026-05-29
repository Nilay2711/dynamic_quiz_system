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

Update `.env` with your MySQL database credentials.

Run:

```bash
php artisan migrate:fresh --seed
```

This command will:

* Create all database tables
* Seed sample quiz data
* Seed test user data

---

## Run Project

### Start Laravel Server

```bash
php artisan serve
```

### Start Vite Development Server

```bash
npm run dev
```

---

## Verify Functionality

Open the application:

```text
http://127.0.0.1:8000/quizzes
```

The database seeder creates sample quiz data for testing.

### Verify Quiz Management

* View quizzes
* Create a quiz
* Delete a quiz

### Verify Question Management

* Add questions
* Edit questions
* Delete questions
* Test all supported question types:
  * Binary
  * Single Choice
  * Multiple Choice
  * Number
  * Text

### Verify Quiz Attempt Flow

* Attempt a quiz
* Submit answers
* Verify score calculation
* Verify percentage calculation
* Verify pass/fail status

### Verify Attempt History

* View previous attempts
* Verify score history
* Verify timestamps

### Verify Media Features

* Upload a question image
* Add a YouTube video URL

---

## Useful Commands

### Reset Database and Seed Data

```bash
php artisan migrate:fresh --seed
```

### Start Laravel Server

```bash
php artisan serve
```

### Start Vite

```bash
npm run dev
```

### Clear Laravel Cache

```bash
php artisan optimize:clear
```

### Run Database Seeder Only

```bash
php artisan db:seed
```

---

## Authentication

Authentication is not implemented in this assignment.

All features are accessible without login.

---

## Author

**Nilay Pandya**