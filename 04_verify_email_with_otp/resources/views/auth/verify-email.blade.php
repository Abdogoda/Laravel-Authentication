<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-200 flex justify-center items-center min-h-screen">
    <div class="bg-gray-800 p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Verify Your Email</h2>
        <p class="text-center text-gray-400 mb-4">Enter the 6-digit OTP sent to your email</p>
        @session('error')
          <p class="text-center text-red-400 mb-4">{{session("error")}}</p>
        @endsession
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="text-center text-red-400 mb-4">{{ $error }}</p>
            @endforeach
        @endif

        
        <form id="otpForm" action="{{url("/verify-email")}}" method="POST">
            @csrf
            <input type="hidden" name="email" value="{{$email}}">
            <div class="flex justify-center space-x-2 mb-6">
                @for ($i = 1; $i <= 6; $i++)
                    <input
                        type="text"
                        autofocus
                        maxlength="1"
                        name="otp[]"
                        class="otp-input w-12 h-12 text-center text-2xl font-semibold rounded border bg-gray-700 text-gray-100 focus:outline-none focus:border-blue-500"
                        required
                        pattern="[0-9]"
                    >
                @endfor
            </div>
            <button type="submit" class="hidden">Verify</button>
        </form>
        
        @error('otp')
            <p class="text-red-500 text-center mt-2">{{ $message }}</p>
        @enderror
    </div>

    <script>
        // Select all OTP input fields
        const otpInputs = document.querySelectorAll('.otp-input');
        const otpForm = document.getElementById('otpForm');

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.match(/[^0-9]/)) { // Only allow numeric input
                    input.value = ''; // Clear invalid input
                }
                
                if (input.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus(); // Move to next input on valid input
                }
                
                if (Array.from(otpInputs).every(i => i.value.length === 1)) {
                    otpForm.submit(); // Submit the form when all inputs are filled
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && input.value === '' && index > 0) {
                    otpInputs[index - 1].focus(); // Move to previous input on Backspace
                }
            });
        });
    </script>
</body>
</html>
