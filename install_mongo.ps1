$ErrorActionPreference = 'Stop'
$url = 'https://windows.php.net/downloads/pecl/releases/mongodb/1.18.0/php_mongodb-1.18.0-8.2-ts-vs16-x64.zip'
$output = 'mongodb.zip'
$destination = 'C:\xampp\php\ext\php_mongodb.dll'

Write-Host "Downloading $url with Start-BitsTransfer..."
Import-Module BitsTransfer
Start-BitsTransfer -Source $url -Destination $output

if ((Get-Item $output).Length -lt 10000) {
    Write-Error "Download failed: File too small (probably error page)"
}

Write-Host "Extracting..."
Expand-Archive -Path $output -DestinationPath 'mongodb_temp' -Force

Write-Host "Installing to $destination..."
Copy-Item 'mongodb_temp\php_mongodb.dll' -Destination $destination -Force

Write-Host "Cleaning up..."
Remove-Item 'mongodb_temp' -Recurse -Force
Remove-Item $output -Force

Write-Host "Done."
