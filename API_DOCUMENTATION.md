# API Documentation

## UM Tagum College — IT15 Final Project

**Base URL:** `http://127.0.0.1:8000/api`  
**Authentication:** Bearer Token (Laravel Sanctum)

---

## Authentication Endpoints

### POST /api/login

**Description:** Login user and get access token  
**Auth Required:** No

**Request Body:**

```json
{
    "email": "admin@school.edu",
    "password": "password"
}
```

**Success Response (200):**

```json
{
    "token": "1|abc123...",
    "user": {
        "id": 1,
        "name": "Admin User",
        "email": "admin@school.edu"
    }
}
```

**Error Response (401):**

```json
{
    "message": "Invalid credentials"
}
```

---

### POST /api/logout

**Description:** Logout and invalidate token  
**Auth Required:** Yes

**Success Response (200):**

```json
{
    "message": "Logged out successfully"
}
```

---

### GET /api/user

**Description:** Get current authenticated user  
**Auth Required:** Yes

**Success Response (200):**

```json
{
    "id": 1,
    "name": "Admin User",
    "email": "admin@school.edu",
    "created_at": "2026-03-11T00:00:00"
}
```

---

## Password Reset Endpoints

### POST /api/forgot-password

**Description:** Send password reset link to email  
**Auth Required:** No

**Request Body:**

```json
{
    "email": "admin@school.edu"
}
```

**Success Response (200):**

```json
{
    "message": "If this email exists, a reset link has been sent."
}
```

---

### POST /api/reset-password

**Description:** Reset password using token from email  
**Auth Required:** No

**Request Body:**

```json
{
    "token": "abc123...",
    "email": "admin@school.edu",
    "password": "newpassword",
    "password_confirmation": "newpassword"
}
```

**Success Response (200):**

```json
{
    "message": "Password reset successfully."
}
```

**Error Response (422):**

```json
{
    "message": "Invalid or expired reset token."
}
```

---

### POST /api/self-register

**Description:** Register new user and receive access code via email  
**Auth Required:** No

**Request Body:**

```json
{
    "name": "Juan Dela Cruz",
    "email": "juan@school.edu"
}
```

**Success Response (200):**

```json
{
    "message": "Access code sent to your email!"
}
```

**Error Response (422):**

```json
{
    "message": "The email has already been taken."
}
```

---

### POST /api/create-password

**Description:** Create password using access code  
**Auth Required:** No

**Request Body:**

```json
{
    "email": "juan@school.edu",
    "access_code": "097079",
    "password": "newpassword",
    "password_confirmation": "newpassword"
}
```

**Success Response (200):**

```json
{
    "message": "Password created successfully! You can now login."
}
```

**Error Response (422):**

```json
{
    "message": "Invalid access code or email."
}
```

---

## Dashboard Endpoints

### GET /api/dashboard

**Description:** Get all dashboard data including stats, charts, and events  
**Auth Required:** Yes

**Success Response (200):**

```json
{
    "students": {
        "total": 500,
        "active": 450,
        "graduated": 50
    },
    "courses": {
        "total": 20
    },
    "enrollment_trend": [{ "month": "Jan", "count": 45 }],
    "course_distribution": [{ "course": "BSIT", "count": 120 }],
    "attendance": [
        { "date": "2024-01-01", "present": 400, "absent": 50, "late": 30 }
    ],
    "recent_events": [
        {
            "id": 1,
            "title": "Midterm Exams",
            "type": "Exam",
            "date": "2024-03-15"
        }
    ]
}
```

---

## Students Endpoints

### GET /api/students

**Description:** Get paginated list of students  
**Auth Required:** Yes  
**Query Params:** `?search=juan&page=1`

**Success Response (200):**

```json
{
    "data": [
        {
            "id": 100001,
            "name": "Juan Dela Cruz",
            "email": "juan@school.edu",
            "course": "BSIT",
            "department": "Engineering",
            "year_level": 2,
            "status": "Active"
        }
    ],
    "total": 500,
    "per_page": 20,
    "current_page": 1
}
```

---

### GET /api/students/summary

**Description:** Get student statistics summary  
**Auth Required:** Yes

**Success Response (200):**

```json
{
    "total": 500,
    "active": 450,
    "graduated": 30,
    "inactive": 20
}
```

---

### GET /api/students/enrollment-stats

**Description:** Get monthly enrollment statistics  
**Auth Required:** Yes

**Success Response (200):**

```json
[
    { "month": "Jan", "count": 45 },
    { "month": "Feb", "count": 52 }
]
```

---

### GET /api/students/course-distribution

**Description:** Get student distribution across courses  
**Auth Required:** Yes

**Success Response (200):**

```json
[
    { "course": "BSIT", "count": 120 },
    { "course": "BSCS", "count": 98 }
]
```

---

## Courses Endpoints

### GET /api/courses

**Description:** Get all courses  
**Auth Required:** Yes  
**Query Params:** `?department=Engineering`

**Success Response (200):**

```json
[
    {
        "id": 1,
        "name": "Bachelor of Science in Information Technology",
        "code": "BSIT",
        "department": "Engineering",
        "units": 3,
        "description": "..."
    }
]
```

---

### GET /api/courses/by-department

**Description:** Get courses grouped by department  
**Auth Required:** Yes

**Success Response (200):**

```json
{
    "Engineering": ["BSIT", "BSCS"],
    "Business": ["BSA", "BSBA"]
}
```

---

### GET /api/courses/summary

**Description:** Get courses count summary  
**Auth Required:** Yes

**Success Response (200):**

```json
{
    "total": 20,
    "departments": 5
}
```
