#  MyWallet - E-Wallet Platform

A comprehensive E-Wallet platform built with **Laravel**, designed for secure financial transactions, efficient withdrawal management, and an engaging user experience.

---

##  Tech Stack

### **Backend**
* **Laravel 13**: The core PHP framework.
* **PHP 8.4**: Server-side language.
* **Stripe SDK & Laravel Cashier**: For secure payment processing and financial integration.
* **Database**: MySQL.

### **Frontend**
* **Tailwind CSS**: Utility-first CSS framework for a responsive, modern UI.
* **FontAwesome**: Extensive icon library used throughout the dashboard and landing page.
* **Vite**: Asset bundling and development server.
* **Blade Templating**: Efficient view rendering engine.

### **Authentication & Utilities**
* **Custom Middleware**: For managing admin/user access and financial transaction logic.

---

##  Getting Started

```bash
# Clone the repository
git clone <repository-url>

# Install PHP dependencies
composer install

# Install JS dependencies
npm install

# Setup environment file
cp .env.example .env
php artisan key:generate
