@echo off
cd C:\xampp\htdocs\my_agenda
php artisan schedule:run >> nul 2>&1
