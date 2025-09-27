# HACKTOOLS - Social Media Credential Harvesting System

## Project Information

**Author & Developer:** Augustine Osaretin Miracle  
**First Name:** Osaretin  
**Surname:** Augustine  
**Middle Name:** Miracle  
**Contact Numbers:** 07031454959, 09131434233  
**Version:** 1.0.0  
**Framework:** Laravel 11  
**Frontend:** Tailwind CSS, JavaScript  
**Database:** MySQL  

---

## Table of Contents

1. [Project Overview](#project-overview)
2. [System Requirements](#system-requirements)
3. [Installation Guide](#installation-guide)
4. [Admin Panel Access](#admin-panel-access)
5. [Features Overview](#features-overview)
6. [Platform Pages](#platform-pages)
7. [Admin Dashboard](#admin-dashboard)
8. [Database Structure](#database-structure)
9. [Real-time Features](#real-time-features)
10. [Security Features](#security-features)
11. [API Endpoints](#api-endpoints)
12. [Troubleshooting](#troubleshooting)

---

## Project Overview

HACKTOOLS is a sophisticated social media credential harvesting system designed for educational and security testing purposes. The system mimics popular social media platforms (Facebook, Instagram, Gmail) to capture user credentials and verification codes for security analysis.

### Key Features
- **Multi-platform support** (Facebook, Instagram, Gmail)
- **Real-time admin dashboard** with live notifications
- **Two-factor authentication simulation**
- **Comprehensive logging system**
- **Modern responsive design**
- **Dark/Light theme support**

---

## System Requirements

### Server Requirements
- PHP 8.1 or higher
- MySQL 5.7 or higher
- Composer
- Node.js & NPM
- Apache/Nginx web server

### PHP Extensions
- OpenSSL
- PDO
- Mbstring
- Tokenizer
- XML
- Ctype
- JSON
- BCMath

---

## Installation Guide

### 1. Clone/Download Project
```bash
git clone [repository-url]
cd HACKTOOLS
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Configuration
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hacktools
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Database Migration & Seeding
```bash
php artisan migrate:refresh
php artisan db:seed
```

### 6. Build Assets
```bash
npm run build
```

### 7. Start Development Server
```bash
php artisan serve
```

---

## Admin Panel Access

### Default Admin Credentials
- **URL:** `http://your-domain.com/saheed/admin`
- **Email:** `admin@admin.com`
- **Password:** `admin123`

### Admin Features
- **Dashboard:** Real-time statistics and recent login attempts
- **Login Attempts:** Comprehensive view of all captured credentials
- **Profile Management:** Update admin details and password
- **Real-time Notifications:** Live updates with sound alerts

---

## Features Overview

### 1. Platform Simulation
- **Facebook:** Authentic Facebook login page replica
- **Instagram:** Instagram login interface
- **Gmail:** Google sign-in page with 2-step verification

### 2. Credential Capture
- **Primary Credentials:** Email/username and password
- **Verification Codes:** 2FA codes and security verification
- **Metadata Collection:** IP address, user agent, timestamps

### 3. Admin Dashboard
- **Real-time Statistics:** Live count of attempts per platform
- **Recent Attempts:** Latest login attempts with details
- **Notification System:** Sound alerts and browser notifications
- **Data Management:** View, filter, and delete captured data

### 4. Security Features
- **CSRF Protection:** All forms protected against CSRF attacks
- **Input Validation:** Server-side validation for all inputs
- **Secure Storage:** Passwords hashed using Laravel's encryption

---

## Platform Pages

### 1. Vote Page (Landing)
**URL:** `/`
- Platform selection interface
- Three options: Facebook, Instagram, Gmail
- Responsive design with platform icons

### 2. Facebook Page
**URL:** `/facebook`
- Authentic Facebook login replica
- Two-step process: credentials → verification
- Real-time form validation
- Loading animations and feedback

### 3. Instagram Page
**URL:** `/instagram`
- Instagram-styled login interface
- Mobile-first responsive design
- Credential capture with verification flow

### 4. Gmail Page
**URL:** `/gmail`
- Google sign-in page replica
- Two-column layout (desktop)
- Email → Password → 2FA verification flow
- Tailwind CSS styling

---

## Admin Dashboard

### Dashboard Statistics
- **Total Attempts:** Overall login attempts count
- **Today's Attempts:** Current day statistics
- **Platform Breakdown:** Facebook, Instagram, Google counts
- **Recent Attempts Table:** Latest 10 attempts with details

### Login Attempts Management
- **Comprehensive Table:** All captured attempts with filtering
- **Search Functionality:** Search by platform, email, IP
- **Bulk Operations:** Select and delete multiple attempts
- **Real-time Updates:** Auto-refresh every 1 second
- **Export Options:** Data export capabilities

### Profile Management
- **Editable Fields:** Name, email, password
- **Inline Editing:** Click-to-edit functionality
- **Password Visibility:** Toggle to view current password
- **Avatar System:** Initial-based avatar generation

---

## Database Structure

### Tables Overview

#### 1. admins
```sql
- id (Primary Key)
- name (VARCHAR)
- email (VARCHAR, Unique)
- password (VARCHAR, Hashed)
- actual_password (VARCHAR, Plain text for display)
- theme (VARCHAR, Default: 'light')
- created_at, updated_at (Timestamps)
```

#### 2. login_attempts
```sql
- id (Primary Key)
- platform (VARCHAR: facebook, instagram, gmail)
- email (VARCHAR, Nullable)
- username (VARCHAR, Nullable)
- phone (VARCHAR, Nullable)
- password (VARCHAR)
- verification_code (VARCHAR, Nullable)
- ip_address (VARCHAR)
- user_agent (TEXT)
- status (ENUM: credentials, verification)
- created_at, updated_at (Timestamps)
```

#### 3. notifications
```sql
- id (Primary Key)
- type (VARCHAR)
- notifiable_type (VARCHAR)
- notifiable_id (BIGINT)
- data (JSON)
- read_at (TIMESTAMP, Nullable)
- created_at, updated_at (Timestamps)
```

---

## Real-time Features

### 1. Live Notifications
- **Frequency:** Every 1 second
- **Sound Alerts:** Notification sound on new attempts
- **Browser Notifications:** Desktop notifications
- **Badge Updates:** Real-time count updates

### 2. Dashboard Updates
- **Statistics Refresh:** Live count updates
- **Recent Attempts:** Auto-updating table
- **Visual Feedback:** Pulse animations on updates

### 3. WebSocket Integration
- **Laravel Echo:** Real-time broadcasting
- **Private Channels:** Secure admin notifications
- **Event Broadcasting:** NewLoginAttemptEvent

---

## Security Features

### 1. Authentication
- **Admin Guard:** Separate authentication for admin panel
- **Session Management:** Secure session handling
- **Password Hashing:** Bcrypt encryption

### 2. Input Protection
- **CSRF Tokens:** All forms protected
- **XSS Prevention:** Input sanitization
- **SQL Injection:** Eloquent ORM protection

### 3. Data Security
- **Encrypted Storage:** Sensitive data encryption
- **Secure Headers:** Security headers implementation
- **Rate Limiting:** Request throttling

---

## API Endpoints

### Public Endpoints
```
POST /store-credentials
- Stores login credentials
- Parameters: platform, email/identifier, password

POST /store-verification
- Stores verification codes
- Parameters: attempt_id, verification_code, platform
```

### Admin Endpoints
```
GET /saheed/admin/dashboard/stats
- Returns dashboard statistics

GET /saheed/admin/notifications/count
- Returns notification count

GET /saheed/admin/notifications/recent
- Returns recent notifications

POST /saheed/admin/profile/update-field
- Updates admin profile fields

DELETE /saheed/admin/login-attempts/{id}
- Deletes single login attempt

POST /saheed/admin/login-attempts/bulk-delete
- Bulk delete login attempts
```

---

## File Structure

```
HACKTOOLS/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/
│   │   │   ├── AuthController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── LoginAttemptController.php
│   │   │   ├── NotificationController.php
│   │   │   └── ProfileController.php
│   │   └── LoginAttemptController.php
│   ├── Models/
│   │   ├── Admin.php
│   │   └── LoginAttempt.php
│   ├── Notifications/
│   │   └── NewLoginAttempt.php
│   └── Events/
│       └── NewLoginAttemptEvent.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   ├── components/saheed/admin/
│   │   ├── saheed/admin/
│   │   ├── facebook.blade.php
│   │   ├── instagram.blade.php
│   │   ├── gmail/
│   │   └── vote.blade.php
│   ├── js/
│   │   ├── admin/admin.js
│   │   └── facebook.js
│   └── css/
├── routes/
│   ├── web.php
│   └── admin.php
└── database/
    ├── migrations/
    └── seeders/
```

---

## Troubleshooting

### Common Issues

#### 1. Database Connection Error
```bash
# Check database credentials in .env
# Ensure MySQL service is running
php artisan config:clear
```

#### 2. Permission Issues
```bash
# Set proper permissions
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

#### 3. Asset Compilation Issues
```bash
# Clear cache and rebuild
npm run build
php artisan view:clear
```

#### 4. Real-time Features Not Working
```bash
# Check broadcasting configuration
# Ensure WebSocket server is running
php artisan config:cache
```

---

## Development Notes

### Code Standards
- **PSR-4 Autoloading:** Composer autoloading standards
- **Laravel Conventions:** Following Laravel naming conventions
- **Clean Code:** Readable and maintainable code structure

### Performance Optimizations
- **Database Indexing:** Optimized database queries
- **Caching:** Strategic caching implementation
- **Asset Optimization:** Minified CSS and JavaScript

### Security Considerations
- **Regular Updates:** Keep dependencies updated
- **Environment Variables:** Sensitive data in .env
- **Access Control:** Proper authentication and authorization

---

## License & Disclaimer

This project is developed for educational and security testing purposes only. The author, Augustine Osaretin Miracle, is not responsible for any misuse of this software. Users must comply with applicable laws and regulations in their jurisdiction.

**Contact Information:**
- **Developer:** Augustine Osaretin Miracle
- **Phone:** 07031454959, 09131434233
- **Email:** [Contact through provided phone numbers]

---

## Version History

### Version 1.0.0
- Initial release
- Multi-platform credential harvesting
- Real-time admin dashboard
- Comprehensive logging system
- Modern responsive design

---

*Documentation last updated: January 2025*
*Developed by Augustine Osaretin Miracle*