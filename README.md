#  E-Wallet System

<p align="center">
  <h3 align="center">Digital Wallet Management System</h3>
  <p align="center">
    Laravel • REST API • MySQL
  </p>
</p>

---

##  Overview Website

https://e-wallet-website.up.railway.app/
---

##  Overview

**E-Wallet System** is a secure digital wallet application built with **Laravel**. It allows users to manage their wallet balances, transfer funds, top up their accounts, and request withdrawals through a RESTful API. The project follows clean architecture principles and provides a solid foundation for building fintech applications.

---

##  Features

* User Authentication & Authorization
* Digital Wallet Management
* Wallet Balance Tracking
* Money Transfers Between Users
* Top-Up Requests
* Withdrawal Requests
* Transaction History
* RESTful API
* Secure Validation & Error Handling
* Admin Management

---

##  Built With

* Laravel
* PHP
* MySQL
* REST API
* Composer
* JavaScript
* Bootstrap
* Vite

---

##  Project Structure

```text
E-wallet/
│
├── app/
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── composer.json
├── package.json
├── artisan
└── README.md
```

---

##  Getting Started

### Clone the repository

```bash
git clone https://github.com/MohamedKhaled31/E-wallet.git
```

### Navigate to the project

```bash
cd E-wallet
```

### Install dependencies

```bash
composer install
npm install
```

### Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

Update your database credentials inside the `.env` file.

### Run migrations

```bash
php artisan migrate
```

### Start the development server

```bash
php artisan serve
```

For frontend assets:

```bash
npm run dev
```

---

##  Main Modules

* Authentication
* Users Management
* Wallet Management
* Transactions
* Money Transfers
* Top-Up Operations
* Withdrawal Requests
* Admin Dashboard

---

##  Author

**Mohamed Khaled**

GitHub:
https://github.com/MohamedKhaled31
