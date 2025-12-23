# Complete Documentation Index

## Table of Contents
1.  [Project Overview](#1-project-overview)
2.  [Technical Architecture](#2-technical-architecture)
3.  [Installation & Setup](#3-installation--setup)
4.  [Database Schema](#4-database-schema)
5.  [API Reference](#5-api-reference)
6.  [Security & Authentication](#6-security--authentication)
7.  [Testing & Verification](#7-testing--verification)

---

## 1. Project Overview
The **Formation API** is a RESTful web service designed to manage an online learning platform. It facilitates interaction between three key roles:
*   **Admin**: System administrator (seeded).
*   **Formateur (Instructor)**: Can create and manage their own courses.
*   **Etudiant (Student)**: Can browse and enroll in courses.

### Key Features
*   **Secure Authentication**: JWT (JSON Web Token) based stateless authentication.
*   **Course Management**: Complete CRUD lifecycle for courses.
*   **Enrollment System**: Management of student subscriptions to courses.
*   **Role-Based Access Control**: Strict policy enforcement for API endpoints.

---

## 2. Technical Architecture
*   **Framework**: Laravel 12 (PHP 8.2+)
*   **Database**: SQLite (Development) / MySQL (Production compatible)
*   **Authentication Provider**: `tymon/jwt-auth`
*   **API Structure**: RESTful resources returning JSON responses.

### Directory Structure Highlights
*   `app/Models`: Eloquent models (`User`, `Formation`, `Inscription`).
*   `app/Http/Controllers`: API logic (`AuthController`, `FormationController`, `InscriptionController`).
*   `routes/api.php`: API route definitions.
*   `database/migrations`: Database schema definitions.

---

## 3. Installation & Setup

### Prerequisites
*   PHP >= 8.2
*   Composer
*   Git

### Step-by-Step Guide
1.  **Clone Repository**
    ```bash
    git clone <repo_url>
    cd formation-api
    ```
2.  **Install Dependencies**
    ```bash
    composer install
    ```
3.  **Configure Environment**
    ```bash
    cp .env.example .env
    # Edit .env to set DB_CONNECTION=sqlite or configure MySQL
    ```
4.  **Generate Keys**
    ```bash
    php artisan key:generate
    php artisan jwt:secret
    ```
5.  **Setup Database**
    ```bash
    touch database/database.sqlite # If using SQLite
    php artisan migrate:fresh --seed
    ```
6.  **Start Server**
    ```bash
    php artisan serve
    ```

---

## 4. Database Schema

### Users Table (`users`)
*   `id`: Primary Key
*   `name`: String
*   `email`: String (Unique)
*   `password`: String (Hashed)
*   `role`: Enum (`admin`, `formateur`, `etudiant`)

### Formations Table (`formations`)
*   `id`: Primary Key
*   `titre`: String
*   `description`: Text
*   `duree`: Integer (Hours)
*   `prix`: Decimal
*   `formateur_id`: Foreign Key -> `users.id`

### Inscriptions Table (`inscriptions`)
*   `id`: Primary Key
*   `user_id`: Foreign Key -> `users.id`
*   `formation_id`: Foreign Key -> `formations.id`
*   `statut`: Enum (`active`, `annulee`, `terminee`)

---

## 5. API Reference

### Authentication
*   `POST /api/register`: Create account.
*   `POST /api/login`: Authenticate and receive Bearer token.
*   `POST /api/logout`: Invalidate token.
*   `GET /api/me`: Get authenticated user details.

### Courses (Formations)
*   `GET /api/formations`: List all courses (Public).
*   `GET /api/formations/{id}`: View course details (Public).
*   `POST /api/formations`: Create course (**Formateur only**).
*   `PUT /api/formations/{id}`: Update course (**Formateur owner only**).
*   `DELETE /api/formations/{id}`: Delete course (**Formateur owner only**).

### Enrollments (Inscriptions)
*   `GET /api/inscriptions`: View my enrollments (**Student only**).
*   `POST /api/inscriptions`: Enroll in a course (**Student only**).
*   `DELETE /api/inscriptions/{id}`: Cancel enrollment (**Student owner only**).

---

## 6. Security & Authentication
The API uses **JWT (JSON Web Tokens)**.
1.  User logs in with credentials.
2.  Server returns a `token`.
3.  Client must send this token in the header of subsequent requests:
    `Authorization: Bearer <your_token_here>`

---

## 7. Testing & Verification
A `walkthrough.md` file is provided in the artifacts for manual testing guidance.
*   **Admin Credentials**: `admin@example.com` / `password`
*   **Formateur Credentials**: `formateur@example.com` / `password`
*   **Student Credentials**: `student@example.com` / `password`
