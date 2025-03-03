<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verify Account</title>
  <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome for icons -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-gray-200 flex justify-center items-center min-h-screen">
  <div class="bg-gray-800 p-6 rounded-lg shadow-md w-full max-w-md">
    <h2 class="text-2xl font-semibold text-center mb-6">Verify Account</h2>
    <p class="text-center text-gray-400 mb-4">Enter the 6-digits OTP sent to your email or phone</p>
    
    @session('error')
      <p class="text-center text-red-400 mb-4">{{ session("error") }}</p>
    @endsession
    @if ($errors->any())
      @foreach ($errors->all() as $error)
        <p class="text-center text-red-400 mb-4">{{ $error }}</p>
      @endforeach
    @endif

    <form id="otpForm" action="{{ url('/verify-account') }}" method="POST">
      @csrf
      <input type="hidden" name="identifier" value="{{ $identifier }}">
      <div class="flex justify-center space-x-2 mb-4">
        @for ($i = 1; $i <= 6; $i++)
          <input
            type="text"
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
    
    <!-- Link to open modal -->
    <p id="openModal" class="text-center text-gray-400 hover:underline cursor-pointer mt-6">
      Or verify with another way?
    </p>
    
    @error('otp')
      <p class="text-red-500 text-center mt-2">{{ $message }}</p>
    @enderror
  </div>

  <!-- Modal for alternate verification methods -->
  <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-gray-800 p-6 rounded-lg shadow-md w-11/12 max-w-sm">
      <h3 class="text-xl font-semibold mb-6 text-center">Choose a Verification Method</h3>
      <div class="flex flex-col space-y-4">
        <!-- Verify with Email Form -->
        <form action="{{url('send-verification-otp')}}" method="POST">
          @csrf
          <input type="hidden" name="identifier" value="{{ $identifier }}">
          <input type="hidden" name="method" value="email">
          <button type="submit" class="flex items-center justify-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
            <i class="fab fa-google text-lg"></i>
            <span>Verify with Email</span>
          </button>
        </form>
        <!-- Verify with Phone Form -->
        <form action="{{url('send-verification-otp')}}" method="POST">
          @csrf
          <input type="hidden" name="identifier" value="{{ $identifier }}">
          <input type="hidden" name="method" value="phone">
          <button type="submit" class="flex items-center justify-center space-x-2 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full">
            <i class="fab fa-whatsapp text-lg"></i>
            <span>Verify with Phone Number</span>
          </button>
        </form>
      </div>
      <button id="modalClose" class="mt-6 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded block mx-auto">Close</button>
    </div>
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

        const openModal = document.getElementById('openModal');
        const modal = document.getElementById('modal');
        const modalClose = document.getElementById('modalClose');
        openModal.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        modalClose.addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    </script>
</body>
</html>
