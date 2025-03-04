<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white flex flex-col items-center justify-center min-h-screen">
    <div class="text-center">
        <h1 class="text-5xl font-bold mb-4">Welcome to My Laravel App</h1>
        <p class="text-lg mb-8">This is a simple landing page built with Laravel and Tailwind CSS.</p>
        <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-600 rounded-lg hover:bg-blue-700 transition">Login</a>
        <a href="{{ route('register') }}" class="px-6 py-3 bg-green-600 rounded-lg hover:bg-green-700 transition ml-4">Register</a>
    </div>
</body>
</html>
