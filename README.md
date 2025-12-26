# SupplyChainHub

Inventory management application to help SMEs track incoming and outgoing stock.

## 📋 Project Description

SupplyChainHub is a web-based application specifically designed to help Small and Medium Enterprises (SMEs) manage their inventory. This application provides features to record incoming goods, outgoing goods, view stock lists, delete stock items, and generate invoices.

**Note:** This is the initial version of the application. Features will continue to be developed according to user needs and requests.

## ✨ Key Features

-   **Stock Management**

    -   Record incoming goods
    -   Record outgoing goods
    -   View stock list
    -   Delete stock items

-   **Invoice**

    -   Create invoices
    -   Export invoices to PDF

-   **Login** (Not yet implemented)

## 🛠️ Technologies Used

-   **Framework:** Laravel 12.43.1
-   **PHP Version:** 8.2 or higher
-   **Database:** SQLite (default) / MySQL / PostgreSQL
-   **PDF Generator:** DomPDF (barryvdh/laravel-dompdf)

## 📦 Requirements

-   PHP >= 8.2
-   Composer
-   SQLite / MySQL / PostgreSQL (as preferred)
-   Required PHP Extensions:
    -   ext-ctype
    -   ext-fileinfo
    -   ext-json
    -   ext-mbstring
    -   ext-openssl
    -   ext-pdo
    -   ext-tokenizer
    -   ext-xml

## 🚀 Installation Guide

1. **Clone or download this repository**

    ```bash
    git clone <repository-url>
    cd SupplyChainHub
    ```

2. **Install dependencies**

    ```bash
    composer install
    ```

3. **Copy environment file**

    ```bash
    cp .env.example .env
    ```

4. **Generate application key**

    ```bash
    php artisan key:generate
    ```

5. **Setup database**

    Edit the `.env` file according to your database configuration:

    ```
    DB_CONNECTION=sqlite
    # or for MySQL:
    # DB_CONNECTION=mysql
    # DB_HOST=127.0.0.1
    # DB_PORT=3306
    # DB_DATABASE=supplychainhub
    # DB_USERNAME=root
    # DB_PASSWORD=
    ```

6. **Run migration**

    ```bash
    php artisan migrate
    ```

7. **Run seeder (optional - to view sample display)**

    ```bash
    php artisan db:seed
    ```

8. **Run the application**

    ```bash
    php artisan serve
    ```

9. **Access the application**

    Open your browser and go to: `http://localhost:8000`

## 💻 How to Use

1. **Setup Localhost**

    - Make sure PHP and Composer are installed on your system
    - Ensure port 8000 is not being used by other applications

2. **Run Development Server**

    ```bash
    php artisan serve
    ```

    The server will run at `http://localhost:8000`

3. **View Sample Data**

    If you have already run the seeder, you can immediately see sample stock data in the application.

4. **Access Features**
    - Navigate to the stock page to view inventory
    - Use the form to add incoming/outgoing goods
    - Generate invoices from existing transactions

## 📁 Struktur Project

```
SupplyChainHub/
├── app/                    # Application logic
│   ├── Http/
│   │   └── Controllers/   # Controllers
│   └── Models/            # Eloquent models
├── database/
│   ├── migrations/        # Database migrations
│   └── seeders/           # Database seeders
├── public/                # Public assets
├── resources/
│   └── views/            # Blade templates
├── routes/               # Route definitions
└── storage/              # Storage files
```

## 🔧 Additional Configuration

### Setting Cache Driver

For production, change in the `.env` file:

```
CACHE_DRIVER=file
```

### PDF Configuration

DomPDF configuration is already included in the project. No additional setup required.

## 🤝 Contributing

This project is still in its early development stage. We are open to suggestions and contributions!

## 📝 Roadmap

Features to be developed:

-   [ ] Authentication system (Login/Register)
-   [ ] Analytics dashboard
-   [ ] Periodic stock reports
-   [ ] Multi-user with role management
-   [ ] Minimum stock notifications
-   [ ] Export data to Excel
-   [ ] And other features based on user feedback

## 📄 License

[Specify appropriate license]

## 👥 Development Team

felice

## 📞 Contact

For questions or suggestions, please contact:

-   Email: [whathuh64@gmail.com]

---

**Note:** This application is created to help SMEs manage their stock more easily and efficiently. Feedback and suggestions are highly appreciated for further development!
