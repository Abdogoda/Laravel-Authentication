<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Passwordless Login</title>
  <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-gray-200">
  <div class="flex justify-center items-center min-h-screen">
      <div class="bg-gray-800 rounded-lg shadow-md w-full max-w-md p-6">
          <h2 class="text-2xl font-semibold text-center mb-6">Passwordless Login</h2>
          
          @if(session('success'))
              <div class="bg-green-500 text-white p-4 rounded mb-4">
                  {{ session('success') }}
              </div>
          @endif

          <form action="" method="POST">
              @csrf
              <div class="mb-4">
                  <label for="email" class="block text-gray-300">Email Address</label>
                  <input type="email" name="email" id="email" autocomplete="email" autofocus class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                  @error('email')
                      <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                  @enderror
              </div>
              <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Send Login Link
              </button>
          </form>
      </div>
  </div>
</body>
</html>
