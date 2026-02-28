# EthioLearning AI - School Project Blueprint

This package adds a complete backend-oriented project blueprint for your **EthioLearning AI self-learning website** with secure authentication, SQL schema, flowchart logic, and implementation notes.

## 1) Recommended Stack

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP 8+ (school-friendly)
- **Database:** MySQL 8+

## 2) Folder Structure

```txt
ethiolearning-ai/
├── README.md
├── docs/
│   ├── project-documentation.md
│   └── system-flowchart.md
├── database/
│   └── schema.sql
└── backend/
    ├── auth.php
    ├── db.php
    ├── login.php
    ├── logout.php
    └── register.php
```

## 3) Quick Setup

1. Create database tables:
   ```bash
   mysql -u root -p < ethiolearning-ai/database/schema.sql
   ```
2. Copy `ethiolearning-ai/backend` into your PHP project root.
3. Update DB credentials in `backend/db.php`.
4. Point your HTML form actions:
   - Register form -> `backend/register.php`
   - Login form -> `backend/login.php`
   - Logout button -> `backend/logout.php`

## 4) Security Included

- Password hashing with `password_hash()`
- Login verification with `password_verify()`
- Prepared statements via PDO
- Session cookie hardening (`httponly`, `samesite`)
- Validation for grade/stream rules

## 5) Documentation

- Full printable documentation: `docs/project-documentation.md`
- Mermaid flowchart version: `docs/system-flowchart.md`

## 6) Note about Admin Login

The provided login system uses a **database-based role** (`role = admin`) instead of hardcoded credentials. This is safer and recommended for grading.
