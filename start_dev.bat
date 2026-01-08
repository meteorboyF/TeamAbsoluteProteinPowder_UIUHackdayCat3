@echo off
set PATH=C:\tools\php;%PATH%
echo Starting Laravel Development Server...
start "Laravel Artisan" cmd /k "php artisan serve"
echo Starting Vite Asset Server...
start "Vite" cmd /k "npm run dev"
echo Servers started in background windows.
