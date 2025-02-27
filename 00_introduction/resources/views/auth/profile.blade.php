<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white mt-20 flex justify-center p-6">
  <div class="max-w-2xl w-full bg-gray-800 rounded-lg shadow-lg overflow-hidden">
    <!-- Profile Header -->
    <div class="p-6 bg-gray-700 flex items-center">
      <img src="https://fakeimg.pl/100x100" alt="Profile Picture" class="w-24 h-24 rounded-full border-4 border-gray-500">
      <div class="ml-6">
       <ul class="space-y-2">
        <li><h2 class="text-2xl font-bold">John Doe</h2></li>
        <li><span class="font-semibold">Email:</span> john.doe@example.com</li>
      </ul>
      </div>
     </div>
  </div>
</body>
</html>
