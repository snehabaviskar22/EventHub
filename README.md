# 🎉 EventHub
### College Event Management & Ticket Booking Platform

EventHub is a full-stack Laravel 12 web application developed as an MCA academic project. It enables colleges to efficiently manage events while allowing students to browse, book, and manage event tickets through an intuitive and responsive web interface.

---

## 📌 Project Overview

Managing college events manually can lead to scheduling conflicts, registration issues, and poor event organization. EventHub provides a centralized platform where administrators can create and manage events, while students can securely register, book tickets, and access their bookings online.

---

## ✨ Features

### 👨‍💼 Admin Module
- Secure Admin Login
- Dashboard with statistics
- Create, Edit & Delete Events
- Publish or Unpublish Events
- Upload Event Banner, Audio & Video Preview
- Set Event Capacity
- Set Booking Deadline
- Specify Eligible Academic Programs
- View All Student Bookings

### 🎓 Student Module
- Student Registration & Login
- Browse Upcoming Events
- View Event Details
- Book Event Tickets
- Demo Payment for Paid Events
- View Booking History
- Download Ticket as PDF
- Booking Confirmation Email

---

## ✅ Smart Booking Validations

The system prevents invalid bookings by checking:

- Booking deadline has not passed
- Student belongs to an eligible academic program
- Seat availability
- Event time conflicts with previously booked events
- Duplicate bookings for the same event

---

## 🛠 Tech Stack

| Technology | Used |
|------------|------|
| Framework | Laravel 12 |
| Language | PHP 8.2+ |
| Database | MySQL |
| ORM | Eloquent ORM |
| Frontend | HTML5, CSS3, Bootstrap 5, JavaScript |
| PDF | barryvdh/laravel-dompdf |
| Authentication | Laravel Authentication |
| Email | Laravel Mail |
| Deployment | Hostinger |

---

# 🗂 Project Structure

```
app/
 ├── Http/
 │    ├── Controllers/
 │    ├── Middleware/
 │    └── Requests/
 │
 ├── Mail/
 ├── Models/
 │
config/

database/
 ├── migrations/
 └── seeders/

public/

resources/
 ├── views/
 ├── css/
 ├── js/

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
├── Time Conflict
└── Duplicate Booking
          │
          ▼
Demo Payment
          │
          ▼
Ticket Generated
          │
          ├── PDF Download
          └── Confirmation Email
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

## Configure Environment

```bash
copy .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

---

## Configure Database

Create a MySQL database named

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

## Run Migrations

```bash
php artisan migrate
```

(Optional)

```bash
php artisan db:seed
```

---

## Storage Link

```bash
php artisan storage:link
```

---

## Run Project

```bash
php artisan serve
```

Open

```
http://127.0.0.1:8000
```

---

# 🎯 Future Enhancements

- QR Code Based Entry
- Online Payment Gateway Integration
- Event Attendance Tracking
- Certificate Generation
- Push Notifications
- Student Feedback & Ratings
- Event Analytics Dashboard
  
---

# 📄 License

This project has been developed for academic and learning purposes.
