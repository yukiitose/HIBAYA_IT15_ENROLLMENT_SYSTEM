# UM Tagum College - IT15 Final Project

## Integrative Programming - Laravel Backend

### Technologies Used

- PHP 8.5
- Laravel 11
- MySQL
- Laravel Sanctum (API Authentication)

### Requirements

- PHP >= 8.2
- Composer
- MySQL
- Laravel 11

### Backend Setup

```bash
cd Final-backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

### API Endpoints

| Method | Endpoint                          | Description               | Auth |
| ------ | --------------------------------- | ------------------------- | ---- |
| POST   | /api/login                        | Login user                | No   |
| POST   | /api/logout                       | Logout user               | Yes  |
| GET    | /api/user                         | Get current user          | Yes  |
| GET    | /api/dashboard                    | Get dashboard data        | Yes  |
| GET    | /api/students                     | Get all students          | Yes  |
| GET    | /api/students/summary             | Get student summary       | Yes  |
| GET    | /api/students/enrollment-stats    | Get enrollment stats      | Yes  |
| GET    | /api/students/course-distribution | Get course distribution   | Yes  |
| GET    | /api/courses                      | Get all courses           | Yes  |
| GET    | /api/courses/by-department        | Get courses by department | Yes  |
| POST   | /api/forgot-password              | Send reset link           | No   |
| POST   | /api/reset-password               | Reset password            | No   |
| POST   | /api/create-password              | Create password           | No   |

### Default Admin Credentials

- Email: admin@school.edu
- Password: password
