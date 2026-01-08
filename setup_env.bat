@echo off
setlocal

echo ==========================================
echo       TEAM ABSOLUTE SETUP SCRIPT
echo ==========================================

echo [1/3] Checking for Winget...
where winget >nul 2>nul
if %errorlevel% neq 0 (
    echo [ERROR] Winget not found. Cannot auto-install.
    echo Please install PHP and Composer manually from:
    echo - https://windows.php.net/download/
    echo - https://getcomposer.org/ 
    pause
    exit /b 1
)

echo [2/3] Installing PHP...
winget install XP8K0HKJFRXGCK --accept-source agreements --accept-package-agreements
if %errorlevel% neq 0 (
    echo [WARNING] PHP install might have failed or already exists.
)

echo [3/3] Installing Composer...
winget install Composer.Composer --accept-source agreements --accept-package-agreements
if %errorlevel% neq 0 (
    echo [WARNING] Composer install might have failed or already exists.
)

echo ==========================================
echo SETUP COMPLETE (Hopefully).
echo CRITICAL: You MUST restart your Terminal/IDE now to load new PATH variables.
echo ==========================================
pause
