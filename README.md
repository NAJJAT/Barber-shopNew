Laravel Project Setup Guide (Windows)
This guide will help you set up the Laravel project on a Windows system.

Prerequisites
Install XAMPP: Ensure you have XAMPP installed with at least PHP version 8.3. You can download it from the official XAMPP website.
Install Composer: After installing XAMPP, install the latest version of Composer. Download it from the Composer website. When prompted in the installer, select the php.exe file that is located in the xampp/php folder (composer usually selects this by default).
Ensure you have Git installed on your system.
Install Node.js: Ensure you have Node.js version 18 installed. Download it from the Node.js website.
Setup Instructions
Clone the Repository

Open Command Prompt or Git Bash.
Run git clone [repository-url] to clone the project.
Install Composer Dependencies

Navigate to the project directory: cd [project-name].
Run composer install.
Set Up Environment File

Copy the .env.example file: copy .env.example .env (use cp in Git Bash).
Modify .env with your database and other environment settings.
Generate Application Key

Run php artisan key:generate.
Database Setup

Run php artisan migrate to create the database schema.
Install NPM Dependencies

Run npm install.
Compile Front-end Assets

Run npm run dev.
Run the Application

Run php artisan serve.
Access the application at http://localhost:8000.
