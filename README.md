📌 E-Commerce System

This project is a full-featured E-Commerce backend system built using Laravel, designed with scalability and clean architecture in mind. It provides a complete solution for managing products, user authentication, shopping cart operations, and order processing through RESTful APIs.

The system leverages Laravel Jetstream for authentication scaffolding, combined with Livewire to deliver dynamic and reactive user interface components without leaving the Laravel ecosystem. For API authentication, Laravel Sanctum is used to generate and manage secure access tokens.

Robust validation is implemented using Form Request classes, ensuring clean and maintainable validation logic while improving security and data integrity.

Additionally, the application supports multi-language (localization) to enhance user experience across different regions.

🚀 Key Features
🔐 Authentication & Authorization using Jetstream + Sanctum
🛍️ Product Management (CRUD APIs)
🛒 Shopping Cart System
📦 Order Processing System
🌍 Multi-language Support (Localization)
⚡ Dynamic UI using Livewire
✅ Clean Validation using Form Requests
🔗 RESTful API Architecture

🛠️ Tech Stack
Backend: Laravel (MVC Architecture)
Frontend: Livewire
Authentication: Jetstream & Sanctum
Database: MySQL
API: RESTful APIs

💡 Project Goal

The goal of this project is to demonstrate the ability to build a modern, secure, and scalable e-commerce system using Laravel ecosystem tools, following best practices in API design, authentication, and code organization.

⚙️ Installation

Follow these steps to run the project locally:
1️⃣ Clone the repository
git clone https://github.com/your-username/E-commerce-Project.git
cd E-commerce-Project
1️⃣ Clone the repository
composer install
npm install
3️⃣ Setup environment
cp .env.example .env
DB_DATABASE=your_db_name
DB_USERNAME=root
DB_PASSWORD=
5️⃣ Run migrations
php artisan migrate
6️⃣ Run the project
php artisan serve
npm run dev
