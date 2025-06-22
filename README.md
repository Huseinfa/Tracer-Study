Tracer Study Website
Welcome to the Tracer Study website, a Laravel-powered platform designed to track and manage alumni data efficiently. Built for educational institutions, this project helps keep tabs on alumni progress with a user-friendly interface and robust backend.
Features

Alumni Management: Add, update, and view alumni records with ease.
User Authentication: Secure login for admins and users with role-based access.
Dashboard Insights: Visualize alumni data through intuitive dashboards.
Data Export/Import: Manage records via CSV or other formats (where implemented).

Tech Stack

Backend: Laravel 10.x, PHP 8.1+
Database: MySQL (managed via phpMyAdmin)
Frontend: Bootstrap 5, JavaScript, Vite for asset compilation
Server: Localhost (Laragon or php artisan serve)
Tools: Composer, npm

Getting Started
Prerequisites

PHP 8.1 or higher
Composer
Node.js (for front-end assets)
MySQL (via phpMyAdmin)
Laragon (optional, for easier local setup)

Installation

Clone the Repository:
git clone https://github.com/Huseinfa/Tracer-Study.git
cd Tracer-Study


Install Dependencies:
composer install
npm install


Set Up Environment:

Copy .env.example to .env:cp .env.example .env


Update .env with your database and mail settings:DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tracer_study
DB_USERNAME=root
DB_PASSWORD=




Generate Application Key:
php artisan key:generate


Run Migrations:
php artisan migrate


Compile Assets:
npm run dev


Start the Server:

Using Laragon: Add the project to Laragon and access via http://tracer-study.test.
Using Artisan:php artisan serve

Access at http://localhost:8000.



Usage

Access the Website: Open http://localhost:8000 (or your Laragon URL) in your browser.
Admin Login: Use the default admin credentials (if seeded) or register a new user.
Manage Alumni: Navigate to the dashboard to add, edit, or view alumni records.
Troubleshooting: Check Laravel logs (storage/logs/laravel.log) for errors.

Contributing
Want to contribute? Awesome! Follow these steps:

Fork the repository.
Create a feature branch (git checkout -b feature/your-feature).
Commit your changes (git commit -m "Add your feature").
Push to the branch (git push origin feature/your-feature).
Open a pull request.

Please ensure your code follows Laravel’s coding standards and includes clear comments.
License
This project is licensed under the MIT License - see the LICENSE file for details.
Contact
For questions or feedback, open an issue on GitHub or reach out via the repository’s discussion tab.
