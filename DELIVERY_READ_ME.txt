================================================================================
          BIKROYBD24 E-COMMERCE - PRODUCTION DEPLOYMENT & HANDOVER GUIDE
================================================================================

PROJECT SUMMARY:
BikroyBD24 is a modern, high-performance Full-Stack E-Commerce Platform built with
Laravel REST API Backend and React Frontend.

--------------------------------------------------------------------------------
STEP 1: UPLOAD & EXTRACT FILES (cPanel / Shared Hosting / VPS)
--------------------------------------------------------------------------------
1. Compress all files in this project directory into a single ZIP file.
2. Log into your cPanel File Manager (or VPS SFTP).
3. Navigate to your website root directory (usually `public_html`).
4. Upload the ZIP file and click "Extract".

--------------------------------------------------------------------------------
STEP 2: IMPORT DATABASE SQL DUMP
--------------------------------------------------------------------------------
1. Open phpMyAdmin from your cPanel dashboard.
2. Create a new MySQL database (e.g. `youruser_bikroybd24`).
3. Create a MySQL user, assign a password, and grant ALL PRIVILEGES.
4. Select your newly created database in phpMyAdmin.
5. Click the "Import" tab at the top.
6. Choose the included file: `bikroybd24_database.sql` from project root.
7. Click "Go" to import all 32 products, categories, coupons, and orders.

--------------------------------------------------------------------------------
STEP 3: CONFIGURE ENVIRONMENT VARIABLES (.env)
--------------------------------------------------------------------------------
1. Open the file `backend/.env` in File Manager.
2. Update your domain and MySQL database connection parameters:

   APP_NAME=BikroyBD24
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=youruser_bikroybd24
   DB_USERNAME=youruser_dbuser
   DB_PASSWORD=your_db_password

3. Ensure `GEMINI_API_KEY` is set for AI Customer Support:
   GEMINI_API_KEY=YOUR_GEMINI_API_KEY

--------------------------------------------------------------------------------
STEP 4: ADMIN ACCESS & ACTIVE FEATURES
--------------------------------------------------------------------------------
ADMIN LOGIN CREDENTIALS:
- Admin Dashboard URL: https://yourdomain.com/#admin
- Email: admin@bikroybd.com
- Password: password123

ACTIVE INTEGRATED FEATURES:
- Native Gemini AI Live Chatbot (Powered by Google Gemini 3.6 Flash)
- Direct WhatsApp Hotline Button (Hotline: +8801854288311)
- Steadfast Courier Fraud Checker (Courier delivery success rate verification)
- Full Admin Control Panel (Product catalog management, stock control, orders, CMS, coupons)

================================================================================
                    PRODUCTION READY FOR INSTANT DEPLOYMENT
================================================================================
