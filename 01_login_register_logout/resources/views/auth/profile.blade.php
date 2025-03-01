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
    <div class="p-6 bg-gray-700 ">
      @session('success')
          <div class="text-green-500 text-sm my-2">{{session('success')}}</div>
      @endsession
      <div class="flex items-center">
        <img src="https://fakeimg.pl/100x100" alt="Profile Picture" class="w-24 h-24 rounded-full border-4 border-gray-500">
        <div class="ml-6">
         <ul class="space-y-2">
          <li><h2 class="text-2xl font-bold">{{auth()->user()->name}}</h2></li>
          <li><span class="font-semibold">Email:</span> {{auth()->user()->email}}</li>
        </ul>
        <form action="{{route('logout')}}" method="post">
          @csrf
          <button type="submit" class="p-2 mt-4 bg-red-600 rounded-lg font-semibold text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">Logout</button>
        </form>
        </div>
      </div>
     </div>
  </div>
</body>
</html>
