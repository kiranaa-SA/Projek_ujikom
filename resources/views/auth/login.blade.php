<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen">

    <!-- Background -->
    <div class="fixed inset-0 bg-cover bg-center" 
         style="background-image: url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=1600&q=80');">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>

    <!-- Login card -->
    <div class="flex items-center justify-center h-screen relative z-10">
        <div class="bg-black/70 rounded-xl shadow-lg w-96 p-8 flex flex-col items-center backdrop-blur">

            <!-- Logo -->
            <img src="{{ asset('assets/images/logos/ChatGPT_Image_Sep_15__2025__09_08_07_AM-removebg-preview.png') }}" 
                 alt="Logo Perpustakaan" class="w-28 h-28 object-contain mb-6">

            <!-- Welcome text -->
            <h2 class="text-2xl font-bold text-white mb-6 tracking-wide">LOGIN</h2>

            <!-- Error message -->
            @if ($errors->any())
                <div class="bg-red-500/20 text-red-300 p-2 rounded mb-4 text-sm w-full text-left">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="w-full">
                @csrf
                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-300" for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-2 bg-transparent border-b-2 border-blue-500 text-white placeholder-gray-400 focus:outline-none focus:border-blue-400">
                </div>

                <div class="mb-6">
                    <label class="block mb-1 font-medium text-gray-300" for="password">Password</label>
                    <input id="password" type="password" name="password" required
                           class="w-full px-4 py-2 bg-transparent border-b-2 border-blue-500 text-white placeholder-gray-400 focus:outline-none focus:border-blue-400">
                </div>

                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition">
                    Log in
                </button>
            </form>

            <!-- Register -->
            <p class="mt-6 text-gray-400 text-sm">
                Belum punya akun? 
                <a href="#" class="text-blue-400 hover:underline">Register di sini</a>
            </p>
        </div>
    </div>

</body>
</html>
