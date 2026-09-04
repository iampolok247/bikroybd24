# BikroyBD24 - Full Laravel Monolithic E-Commerce Platform

A high-performance, full-stack E-Commerce platform built entirely with **Laravel 11, Blade Templates, HTML5, Tailwind CSS, and Vanilla/Alpine JS**. Ready for direct deployment on **cPanel / Shared Hosting / VPS** and automated deployment via **GitHub Actions CI/CD**.

---

## 🏗 Architecture & Stack
- **Framework**: Laravel 11 (Monolithic Architecture)
- **Frontend / Views**: Laravel Blade (`resources/views/`), Tailwind CSS (`public/css/app.css`), HTML5 Semantic Structure
- **Client Logic & Reactive Interactivity**: Standalone JavaScript (`public/js/app.js` & `public/js/admin.js`) — **No Node.js or Vite build runtime needed on shared cPanel hosting!**
- **Database**: MySQL / MariaDB (Compatible with phpMyAdmin import `bikroybd24_database.sql`)
- **Third-Party Integrations**: Google Gemini 2.0 AI Live Chatbot, Steadfast Courier API (Fraud Check & Auto Tracking), Direct WhatsApp Hotline.

---

## 🚀 Quick Setup (Local Development)

### 1. Prerequisites
- **PHP**: 8.2 or higher
- **MySQL / XAMPP**: Active on `127.0.0.1:3306` (Database: `bikroybd24_db`)
- **Composer**: Installed locally

### 2. Run Locally
```bash
# 1. Install Composer dependencies
composer install

# 2. Setup Environment
cp .env.example .env
php artisan key:generate

# 3. Migrate and Seed Database (or import bikroybd24_database.sql into phpMyAdmin)
php artisan migrate:fresh --seed

# 4. Start the Laravel Local Server
php artisan serve
```
Open your browser at: **`http://127.0.0.1:8000`**

---

## 🌐 Deploy to cPanel / Shared Hosting (2 Ways)

### Method A: Automated Deployment via GitHub Actions (CI/CD)
1. Push this entire repository to your GitHub repository (`main` branch).
2. Go to your GitHub Repo -> **Settings** -> **Secrets and variables** -> **Actions** -> **New repository secret**.
3. Add the following secrets:
   - `CPANEL_FTP_SERVER`: Your cPanel host/IP (e.g. `ftp.yourdomain.com` or server IP)
   - `CPANEL_FTP_USERNAME`: Your FTP username (e.g. `user@yourdomain.com` or cPanel username)
   - `CPANEL_FTP_PASSWORD`: Your FTP password
   - `CPANEL_SERVER_DIR`: Destination directory (e.g. `public_html/` or `public_html/yourfolder/`)
4. Every push to `main` will automatically build dependencies and sync files to your cPanel hosting!

---

### Method B: Manual cPanel ZIP Upload
1. Compress all files in this project directory into a single `.zip` file.
2. In cPanel **File Manager**, navigate to `public_html/` and click **Upload**.
3. Extract the ZIP file into `public_html/`.
4. Open phpMyAdmin, create your database (e.g. `youruser_bikroybd24`), and **Import** `bikroybd24_database.sql`.
5. Edit `.env` in `public_html/` to update database name, user, and password:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com

   DB_DATABASE=youruser_bikroybd24
   DB_USERNAME=youruser_dbuser
   DB_PASSWORD=your_db_password
   ```
6. Your website is 100% LIVE immediately!

---

## 🔑 Default Admin Credentials
- **Admin Dashboard URL**: `https://yourdomain.com/admin` or `http://127.0.0.1:8000/admin`
- **Admin Email**: `admin@bikroybd24.com` (or `admin@bikroybd.com`)
- **Admin Password**: `admin123` (or `password123`)
- **Default Discount Coupon**: `NEXABD500` (৳500 instant discount)

---

## 📦 Features Included
- **Storefront**: Hero carousel, flash sales countdown, dynamic categories, real-time live search, quick view modal, wishlist, slide-in cart drawer, and 1-step checkout.
- **Delivery Calculation**: Inside Dhaka (৳70) & Outside Dhaka (৳130) with free shipping progress threshold over ৳3,000.
- **Admin CMS**: Overview revenue & order statistics, product inventory manager, category manager, order status changer, promo coupon creator, customer analytics, and audit logs.
- **Live Gemini AI Chatbot**: Native floating widget answering customer inquiries in Bangla & English.
- **Steadfast Courier Fraud Indicator**: Instant delivery trust calculation based on phone history.
- **WhatsApp Hotline Button**: Direct 1-tap WhatsApp chat with customer support.
