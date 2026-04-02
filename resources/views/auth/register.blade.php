<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Perpustakaan</title>

    <link rel="icon" href="{{ asset('assets/images/logos/ChatGPT_Image_Sep_15__2025__09_08_07_AM-removebg-preview.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen overflow-hidden">

    <!-- Background (ASLI, TANPA OVERLAY) -->
    <div class="fixed inset-0 bg-cover bg-center"
         style="background-image: url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=1600&q=80');">
    </div>

    <!-- Register Card -->
    <div class="flex items-center justify-center h-screen relative z-10">
        <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl w-96 p-8 flex flex-col items-center">

            <!-- Logo -->
            <img src="{{ asset('assets/images/logos/ChatGPT_Image_Sep_15__2025__09_08_07_AM-removebg-preview.png') }}"
                 alt="Logo Perpustakaan"
                 class="w-24 h-24 object-contain mb-4">

            <h2 class="text-2xl font-bold text-gray-800 mb-6 tracking-wide">REGISTER</h2>

            <!-- Error -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-sm w-full">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}" class="w-full">
                @csrf

                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                           class="w-full px-3 py-2 bg-white/70 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400 @error('name') border-red-500 @enderror">
                    @error('name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-3 py-2 bg-white/70 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400 @error('email') border-red-500 @enderror">
                    @error('email')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Password</label>
                    <input type="password" name="password" required
                           class="w-full px-3 py-2 bg-white/70 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400 @error('password') border-red-500 @enderror">
                    @error('password')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-1 font-medium text-gray-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full px-3 py-2 bg-white/70 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-full transition">
                    Register
                </button>
            </form>

            <p class="mt-6 text-gray-600 text-sm">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login di sini</a>
            </p>

        </div>
    </div>

</body>
</html>
