# 🏥 Nexus Health Pro | Clinical Management Suite

**Nexus Health Pro** is a high-performance clinical management platform designed to streamline medical operations, secure patient data via industry-standard authentication, and provide real-time clinical analytics. 

**Live Demo:** [https://nexus-care-wxci.onrender.com/](https://nexus-care-wxci.onrender.com/)

Built with a focus on speed and aesthetic excellence, this application leverages a robust **Laravel 11** backend and a custom **Glassmorphism SPA** frontend.

---

## 🚀 Key Features

- **🔐 Secure Authentication:** Full API-based auth system using **Laravel Sanctum**. (Register, Login, logout).
- **📋 Patient Archive:** Centralized directory to manage and search patient medical profiles.
- **👨‍⚕️ Staff Management:** Real-time visibility of active medical professionals and specialists.
- **📅 Appointment Engine:** Dynamic scheduling system allowing admins to link patients and doctors effortlessly.
- **📊 Operations Dashboard:** Instant clinical metrics including total patient counts, staff duty logs, and recent activity timelines.
- **🐳 DevOps Ready:** Includes a production-optimized **Dockerfile** for instant deployment on cloud providers (Render, Fly.io, etc.).

---

## 🛠️ Tech Stack

- **Backend:** PHP 8.3 + Laravel 11
- **Auth:** Laravel Sanctum (Bearer Token)
- **Database:** SQLite (Default for portability) / MySQL compatible
- **Frontend:** Vanilla JavaScript (ES6+), CSS Grid/Flexbox, HTML5
- **Icons:** Lucide Icons
- **Deployment:** Docker

---

## 📦 Local Installation Guide

Follow these steps to get the clinical engine running on your local machine:

### 1. Prerequisites
Ensure you have **PHP 8.2+** and **Composer** installed.

### 2. Clone and Install
```bash
git clone https://github.com/japesh5579/health_care.git
cd health_care
composer install
```

### 3. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Initialization
This command will create the local SQLite database, run migrations, and populate the system with expert doctors and sample patients:
```bash
touch database/database.sqlite
php artisan migrate:fresh --seed
```

### 5. Start the Engine
```bash
php artisan serve
```
Visit the application at: **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---

## 📖 How to Use

### 1. Security Check
By default, the dashboard is protected. 
- **Sign Up:** Navigate to the "Sign Up" tab in the login overlay to create your first Administrative account.
- **Log In:** Use your credentials to enter the clinical operations suite. The system will securely store your session token in `localStorage`.

### 🔑 Demo Credentials
For easy testing, you can use the following pre-seeded admin account:
- **Email:** `jhatta@gmail.com`
- **Password:** `jhatta12345`

### 2. Clinical Operations
- **Dashboard:** View top-level stats and recent appointment activity.
- **Register Patients:** Use the "Quick Register" form to add new patients to the clinical archive.
- **Schedule Appointments:** Go to the "Appointments" tab. Use the "Schedule New" form to select a patient and doctor from the automated dropdowns and confirm clinic time.

---

## ☁️ Deployment (Cloud)

This project is pre-configured for **Render.com** or **Fly.io** using Docker.

1. Connect your GitHub repository to Render.
2. Create a new **Web Service**.
3. Render will automatically detect the `Dockerfile`.
4. The system will build and deploy your HTTPS-secured link instantly.

---

## 📡 API Endpoints (Documentation)

| Method | Endpoint | Description | Auth Required |
| :--- | :--- | :--- | :--- |
| POST | `/api/register` | Create a new Admin | No |
| POST | `/api/login` | Obtain Bearer Token | No |
| GET | `/api/patients` | Fetch all patient records | Yes |
| POST | `/api/patients` | Register new patient | Yes |
| GET | `/api/doctors` | Fetch medical staff | Yes |
| GET | `/api/appointments` | Fetch all appointments | Yes |
| POST | `/api/appointments`| Schedule appointment | Yes |

---
*Developed by [Japesh](https://github.com/japesh5579)*

**Demo Login Credentials:**
- **Email:** `jhatta@gmail.com`
- **Password:** `jhatta12345`
