@echo off
set PATH=C:\tools\php;%PATH%
cd /d "%~dp0"
echo Downloading Composer Installer...
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
echo Installing Composer...
php composer-setup.php
php -r "unlink('composer-setup.php');"
echo Composer installed to %CD%\composer.phar
echo You can now use: php composer.phar install
