<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white flex items-center justify-center h-screen">
  <div class="w-full max-w-md p-8 space-y-6 bg-gray-800 rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold text-center">Login</h2>
    @session('error')
        <div class="text-red-500 text-sm mt-1">{{session("error")}}</div>
    @enderror
    @session('success')
        <div class="text-green-500 text-sm mt-1">{{session("success")}}</div>
    @enderror
    <form action="{{url("login")}}" method="POST" class="space-y-4">
      @csrf
      <div>
        <label for="email" class="block mb-2 text-sm font-medium">Email</label>
        <input type="email" id="email" name="email" autocomplete="off" autofocus class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error('email')
            <span class="text-red-500 text-sm mt-1">{{$message}}</span>
        @enderror
      </div>
      <div>
        <label for="password" class="block mb-2 text-sm font-medium">Password</label>
        <input type="password" id="password" name="password" class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error('password')
            <span class="text-red-500 text-sm mt-1">{{$message}}</span>
        @enderror
      </div>
      <p class="mt-4 text-sm">Forgot your passsword? <a href="{{route("password.request")}}" class="text-blue-400 hover:underline">Reset now</a></p>
      <button type="submit" class="w-full py-3 mt-4 bg-blue-600 rounded-lg font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Login</button>
      
        <!-- Social Login Buttons Row -->
        <div class="flex justify-between mt-4">
          <!-- Google Login Button -->
          <a href="{{ url('/auth/google/redirect') }}" class="flex items-center justify-center w-1/3 py-3 bg-red-500 rounded-lg font-semibold text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 mr-2">
            <i class="fa-brands fa-google fa-lg mr-3"></i>
            Google
          </a>
  
          <!-- GitHub Login Button -->
          <a href="{{url('/auth/github/redirect')}}" class="flex items-center justify-center w-1/3 py-3 bg-gray-600 rounded-lg font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600 mx-2">
            <i class="fa-brands fa-github fa-lg mr-3"></i>
            GitHub
          </a>

          <!-- Facebook Login Button -->
          <a href="{{url('/auth/facebook/redirect')}}" class="flex items-center justify-center w-1/3 py-3 bg-blue-600 rounded-lg font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 ml-2">
            <i class="fab fa-facebook-f fa-lg mr-2"></i>
            Facebook
          </a>
        </div>
      <p class="mt-4 text-sm text-center">Don’t have an account? <a href="{{route("register")}}" class="text-blue-400 hover:underline">Register</a></p>
    </form>
  </div>
</body>
</html>
