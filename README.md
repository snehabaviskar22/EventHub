# 🎉 EventHub
### College Event Management & Ticket Booking Platform

![Laravel](https://img.shields.io/badge/Laravel-12-red)
![PHP](https://img.shields.io/badge/PHP-8.2-blue)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-purple)
![Railway](https://img.shields.io/badge/Deployed-Railway-success)

EventHub is a full-stack Laravel 12 web application developed as an MCA academic project. It provides a centralized platform where colleges can manage events efficiently while students can browse events, book tickets, receive confirmation emails, and download tickets online.

---

# 🌐 Live Demo

**Live Project**

👉 https://eventhub-production-cfbe.up.railway.app/

---

# 📷 Screenshots

## Home Page

<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/98c55da5-bf74-414d-b8e0-7dc9ced82784" />


---

## Event Details

<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/d232b9e7-d6a6-4f58-b3c8-e98e7637b8f2" />

---

## Student Bookings

<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/c2943668-4f08-4bd4-863e-98ef7affdbc3" />


---

## Admin Dashboard

<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/cd16b7b3-a01e-4007-961c-0d89ab047d65" />


---

## Event Creation

<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/47a28642-4273-4949-bad0-0a28ba2dd034" />


---

# 📌 Project Objectives

The primary objectives of EventHub are:

- Develop a centralized event management platform for educational institutions.
- Simplify event creation and management for administrators.
- Allow students to browse and register for events online.
- Prevent duplicate and conflicting event bookings.
- Generate downloadable PDF tickets.

---

# ✨ Features

## 👨‍💼 Admin Module

- Secure Admin Authentication
- Dashboard with Statistics
- Create Events
- Edit Events
- Delete Events
- Publish / Unpublish Events
- Upload Event Banner
- Upload Event Audio Preview
- Upload Event Video Preview
- Seat Capacity Management
- Booking Deadline Management
- Eligible Academic Program Selection
- View Student Bookings

---

## 🎓 Student Module

- Student Registration
- Secure Login
- Browse Upcoming Events
- Event Details Page
- Demo Payment System
- Book Event Tickets
- Download Ticket PDF
- View Booking History

---

# ✅ Smart Booking Validations

The system automatically checks:

- ✅ Booking Deadline
- ✅ Seat Availability
- ✅ Duplicate Bookings
- ✅ Academic Program Eligibility
- ✅ Time Conflict with Existing Bookings

---

# ☁ Cloud Features

- Cloud Deployment using Railway
- Cloudinary Media Storage
- MySQL Database
- Responsive UI

---

# 🛠 Technology Stack

| Category | Technology |
|-----------|------------|
| Backend | Laravel 12 |
| Language | PHP 8.2 |
| Frontend | HTML5 |
| Styling | CSS3, Bootstrap 5 |
| JavaScript | JavaScript |
| Database | MySQL |
| ORM | Eloquent ORM |
| Authentication | Laravel Authentication |
| PDF Generation | barryvdh/laravel-dompdf |
| Media Storage | Cloudinary |
| Deployment | Railway |
| Version Control | Git & GitHub |

---

# 🗂 Project Structure

```
app/
│
├── Http/
│   ├── Controllers/
│   ├── Middleware/
│   └── Requests/
│
├── Mail/
├── Models/
│
config/
database/
│   ├── migrations/
│   └── seeders/
│
public/
resources/
│   ├── views/
│   ├── css/
│   └── js/
│
routes/
storage/
```

---

# 🗄 Database Tables

- users
- events
- tickets
- sessions
- cache
- jobs

---

# 🔄 Booking Workflow

```
Student Register/Login
          │
          ▼
Browse Events
          │
          ▼
View Event Details
          │
          ▼
Book Ticket
          │
          ▼
Validation Checks
│
├── Booking Deadline
├── Seat Availability
├── Eligible Program
├── Duplicate Booking
└── Time Conflict
          │
          ▼
Demo Payment
          │
          ▼
Ticket Generated
          │
          ├── Download PDF
```

---

# 🚀 Installation

## Clone Repository

```bash
git clone https://github.com/yourusername/EventHub.git
```

```bash
cd EventHub
```

---

## Install Dependencies

```bash
composer install
```

---

## Create Environment File

```bash
cp .env.example .env
```

Generate Application Key

```bash
php artisan key:generate
```

---

## Configure Database

Create a MySQL Database

```
eventhub
```

Update your `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eventhub
DB_USERNAME=root
DB_PASSWORD=
```

---

## Configure Cloudinary (Optional for Production)

```env
CLOUDINARY_URL=cloudinary://API_KEY:API_SECRET@CLOUD_NAME
```

---

## Run Migrations

```bash
php artisan migrate
```

(Optional)

```bash
php artisan db:seed
```

---

## Create Storage Link

```bash
php artisan storage:link
```

---

## Start Development Server

```bash
php artisan serve
```

Open

```
http://127.0.0.1:8000
```

---

# 📈 Future Enhancements

- QR Code Based Event Entry
- Online Payment Gateway
- Attendance Tracking
- Student Feedback & Ratings
- Event Search & Filtering

---

# 👩‍💻 Developer

**Sneha Baviskar**

MCA Student


---

# 📄 License

This project has been developed for academic and learning purposes.
