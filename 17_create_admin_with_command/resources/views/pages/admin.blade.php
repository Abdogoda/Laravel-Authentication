<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-200">
    <div class="container mx-auto mt-10 p-2">
        <div class="flex justify-between align-center mb-2">
          <h1 class="text-3xl font-bold mb-6">Admin Page</h1>
            <a href="/profile" class="bg-green-600 text-white px-4 py-2 rounded h-fit">Profile</a>
        </div>
        <div class="bg-gray-800 rounded-lg shadow-md mb-4">
            <div class="font-medium text-gray-400 border-gray-700 p-5">
                <p>Only authenticated users with the role of <b>(admin)</b> can visit and view this page.</p>
            </div>
        </div>
    </div>
</body>
</html>
