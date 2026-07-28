# Youth - E-Commerce & Community Web Platform

**Youth** is a modern e-commerce and community web application built with **Laravel 11**, **MySQL**, **TailwindCSS**, **Alpine.js**, and **Vite**. The platform provides a public-facing storefront for product discovery, promotion-driven shopping (offers & events), customer order management, and interactive community features (blogs, nested comment/reply threads, user ask questions, wishlists), paired with an administrative dashboard for store and content management.

---

## 🚀 Key Features

### 🛍️ Public Storefront
- **Dynamic Product Catalog**: Browse products organized by Menus, Categories, Subcategories, Brands, and Tags.
- **Advanced Filtering & Sorting**: Filter products by category, brand, size, color, and dynamic price sliders; sort by new arrivals, price (low-to-high, high-to-low), and popularity.
- **Promotions, Offers & Special Events**: Dedicated landing pages for special promotional offers (`/youth/offer/{offer_slug}`) and seasonal events (`/youth/event/{event_slug}`).
- **Shopping Cart & Checkout**: Interactive Ajax cart updates, tax calculations, coupon/promo code application, and multi-step checkout workflow.
- **Customer Dashboard**: Track order status, view detailed order history and itemized invoice details, manage wishlist items, and update profile settings.
- **Interactive Community & Blog**: Read articles by category, publish comments, and participate in nested reply threads (`parent_id` comment system).

### ⚙️ Admin Management Panel
- **Product Management**: Full CRUD operations for products, bulk asset uploads, multi-color and size variants, stock inventory management, and promotional linking (Offers / Events).
- **Taxonomy & Attributes**: Manage Menus, Categories, Subcategories, Brands, Sizes, and Colors.
- **Promotional Banners & Events**: Create and activate Hero Banners, Special Offers, and Event campaigns.
- **Order Processing**: Review incoming orders, update fulfillment statuses (pending, processing, delivered, cancelled), and generate invoices.
- **User & Access Management**: Control user roles, user ban status, review contact messages, and handle newsletter subscriptions.

---

## 🛠️ Technology Stack

| Layer | Technology                                                                 |
| :--- |:---------------------------------------------------------------------------|
| **Backend Framework** | [Laravel 11.x](https://laravel.com/) (PHP ^8.2)                            |
| **Database** | MySQL                                                                      |
| **Frontend Templates** | Blade Templating Engine                                                    |
| **Styling & UI** | [TailwindCSS 3](https://tailwindcss.com/), Custom Vanilla CSS, FontAwesome |
| **Interactivity** | [Alpine.js](https://alpinejs.dev/), jQuery, Vite 5                         |
| **Package Managers** | Composer (PHP), NPM (Node.js)                                              |

---

## ⚙️ Prerequisites & System Requirements

Ensure your local development environment meets the following requirements:

- **PHP**: `>= 8.2` (Required extensions: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`)
- **Composer**: `>= 2.x`
- **Node.js**: `>= 18.x` & **NPM**: `>= 9.x`
- **Database**: MySQL `>= 8.0` or MariaDB `>= 10.4` (Laragon / Laravel Herd / XAMPP supported)

---

## 🏁 Step-by-Step Setup & Installation Guide

### 1. Clone the Repository
```bash

git clone <repository-url>
cd Youth
```

### 2. Install PHP Dependencies
```bash

composer install
```

### 3. Install Frontend Dependencies
```bash

npm install
```

### 4. Configure Environment File
Copy the example environment configuration file to `.env`:
```bash

cp .env.example .env
```

Open `.env` in your text editor and update your database credentials:
```ini
APP_NAME=Youth
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=youth
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key & Link Storage
```bash

php artisan key:generate
php artisan storage:link
```

### 6. Run Database Migrations & Seeders
Execute database migrations to set up the database schema and populate seed data (Categories, Menus, Brands, Seed Products, Admin/User Accounts):
```bash

php artisan migrate:fresh --seed
```

---

## 🚀 Running the Project Locally

To run the application locally, start both the Laravel development server and Vite asset compiler:

### Terminal 1: Run Laravel Backend Server
```bash

php artisan serve
```
The application will be accessible at: `http://127.0.0.1:8000`

### Terminal 2: Run Vite Asset Compiler
```bash

npm run dev
```

---

## ⚡ Useful Maintenance & Artisan Commands

| Task | Command |
| :--- | :--- |
| **Run Migrations** | `php artisan migrate` |
| **Reset Database & Re-seed** | `php artisan migrate:fresh --seed` |
| **Clear Application Cache** | `php artisan cache:clear` |
| **Clear Route & Config Cache** | `php artisan config:clear && php artisan route:clear && php artisan view:clear` |
| **Optimize for Production** | `php artisan optimize` |
| **Build Production Assets** | `npm run build` |

---

## 📄 License

This project is open-sourced under the [MIT License](LICENSE).
