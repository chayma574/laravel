# Course Management API

A robust RESTful API for managing online courses, built with Laravel 12. This system handles user authentication (JWT), course management (CRUD), and student enrollments.

## 🚀 Features

-   **Authentication**: Secure JWT-based authentication (Login, Register, Logout, Refresh Token).
-   **Role-Based Access Control (RBAC)**:
    -   **Admin**: Full system access (seeded).
    -   **Formateur (Instructor)**: Create, update, and delete their own courses.
    -   **Etudiant (Student)**: Browse courses and enroll in them.
-   **Course Management**: Full CRUD operations for courses.
-   **Enrollment System**: Students can enroll in courses and manage their enrollments.
-   **API Security**: Protected routes using `auth:api` middleware.

## 🛠️ Tech Stack

-   **Framework**: Laravel 12
-   **Language**: PHP 8.2+
-   **Database**: SQLite (Default) / MySQL (Compatible)
-   **Authentication**: `tymon/jwt-auth`
-   **API Testing**: Postman / cURL

## 📂 Project Structure

```
formation-api/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php       # Handles JWT Auth (Login, Register...)
│   │   │   ├── FormationController.php  # Handles Course CRUD
│   │   │   └── InscriptionController.php# Handles Enrollments
│   ├── Models/
│   │   ├── User.php                     # User model with JWT implementation
│   │   ├── Formation.php                # Course model
│   │   └── Inscription.php              # Enrollment model
├── config/
│   └── auth.php                         # Auth configuration (JWT driver setup)
├── database/
│   ├── migrations/                      # Database schemas
│   └── seeders/                         # Test data seeders
└── routes/
    └── api.php                          # API Routes definition
```

## ⚙️ Installation & Setup

1.  **Clone the repository**
    ```bash
    git clone <repository-url>
    cd formation-api
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    ```

3.  **Environment Setup**
    ```bash
    cp .env.example .env
    php artisan key:generate
    php artisan jwt:secret
    ```

4.  **Database Setup**
    Create the SQLite database file (if using SQLite):
    ```bash
    touch database/database.sqlite
    ```
    Run migrations and seeders:
    ```bash
    php artisan migrate:fresh --seed
    ```

5.  **Run the Server**
    ```bash
    php artisan serve
    ```
    The API will be available at `http://127.0.0.1:8000`.

## 🔌 API Endpoints

### Authentication
| Method | Endpoint | Description | Auth Required |
| :--- | :--- | :--- | :--- |
| POST | `/api/register` | Register a new user | No |
| POST | `/api/login` | Login and get JWT token | No |
| POST | `/api/logout` | Invalidate current token | Yes |
| POST | `/api/refresh` | Refresh expired token | Yes |
| GET | `/api/me` | Get current user profile | Yes |

### Courses (Formations)
| Method | Endpoint | Description | Auth Required | Role |
| :--- | :--- | :--- | :--- | :--- |
| GET | `/api/formations` | List all courses | No | All |
| GET | `/api/formations/{id}` | Get course details | No | All |
| POST | `/api/formations` | Create a new course | Yes | Formateur |
| PUT | `/api/formations/{id}` | Update a course | Yes | Formateur (Owner) |
| DELETE | `/api/formations/{id}` | Delete a course | Yes | Formateur (Owner) |

### Enrollments (Inscriptions)
| Method | Endpoint | Description | Auth Required | Role |
| :--- | :--- | :--- | :--- | :--- |
| GET | `/api/inscriptions` | List my enrollments | Yes | Student |
| POST | `/api/inscriptions` | Enroll in a course | Yes | Student |
| DELETE | `/api/inscriptions/{id}` | Cancel enrollment | Yes | Student (Owner) |

## 🧪 Testing

You can test the API using the provided `walkthrough.md` guide or by importing the endpoints into Postman.

### Default Test Users (Seeded)
-   **Admin**: `admin@example.com` / `password`
-   **Formateur**: `formateur@example.com` / `password`
-   **Student**: `student@example.com` / `password`
"# my-project" 
"# my-project" 
