<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Service Unavailable - {{ config('app.name') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-secondary-50 flex flex-col items-center justify-center p-4">
    <div class="max-w-md w-full text-center space-y-6">
        <!-- Logo/Icon -->
        <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-primary-100 ring-8 ring-primary-50">
            <svg class="h-10 w-10 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
            </svg>
        </div>

        <div>
            <h1 class="text-4xl font-bold font-display text-secondary-900 tracking-tight">System Upgrade</h1>
            <p class="mt-4 text-base text-secondary-500">We are currently performing scheduled maintenance to improve our services. We'll be back shortly!</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-secondary-200">
            <div class="flex items-center justify-between text-sm">
                <span class="text-secondary-500">Service Status</span>
                <span class="flex items-center text-yellow-600 font-medium bg-yellow-50 px-2 py-1 rounded">
                    <span class="w-2 h-2 rounded-full bg-yellow-500 mr-2 animate-pulse"></span>
                    Maintenance Mode
                </span>
            </div>
            <div class="mt-4 pt-4 border-t border-secondary-100 flex items-center justify-between text-sm">
                <span class="text-secondary-500">Estimated Return</span>
                <span class="font-medium text-secondary-900">~15 Minutes</span>
            </div>
        </div>

        <div>
            <button onclick="window.location.reload()" class="text-primary-600 hover:text-primary-700 font-medium text-sm transition-colors">
                Check Status &rarr;
            </button>
        </div>
    </div>
</body>
</html>
