<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.24.0/dist/full.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen relative">
    <div class="absolute inset-0 bg-cover bg-center grayscale" style="background-image: url('{{ asset('landpage') }}/asset/bg.png'); z-index: -1;"></div>
    <div class="absolute top-5 left-32 w-80 h-auto z-10">
        <img src="{{ asset('landpage') }}/asset/logo_light.png" alt="Logo" class="w-full h-auto">
    </div>
    <div class="flex items-center justify-end min-h-screen">
        <div class="rounded-bl-[100px] w-1/2 h-screen bg-[#1A4D2E] shadow-xl text-white">
            <div class="py-20 px-48">
                <h2 class="text-4xl font-bold mb-8 font-[Poppins]">Daftar</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-4">
                        <label class="block text-lg mb-2 font-[Nunito]" for="name">Nama</label>
                        <input id="name" class="w-full px-4 py-2 text-black bg-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" 
                               type="text" 
                               name="name" 
                               :value="old('name')" 
                               required autofocus autocomplete="name" placeholder="Nama">
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600" />
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-lg mb-2 font-[Nunito]" for="email">Email</label>
                        <input id="email" class="w-full px-4 py-2 text-black bg-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" 
                               type="email" 
                               name="email" 
                               :value="old('email')" 
                               required autocomplete="username" placeholder="Email">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                    </div>

                    <!-- No HP -->
                    <div class="mb-4">
                        <label class="block text-lg mb-2 font-[Nunito]" for="no_hp">No HP</label>
                        <input id="no_hp" class="w-full px-4 py-2 text-black bg-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" 
                               type="text" 
                               name="no_hp" 
                               :value="old('no_hp')" 
                               required placeholder="No HP">
                        <x-input-error :messages="$errors->get('no_hp')" class="mt-2 text-red-600" />
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <label class="block text-lg mb-2 font-[Nunito]" for="password">Password</label>
                        <input id="password" class="w-full px-4 py-2 text-black bg-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" 
                               type="password" 
                               name="password" 
                               required autocomplete="new-password" placeholder="Password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label class="block text-lg mb-2 font-[Nunito]" for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" class="w-full px-4 py-2 text-black bg-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" 
                               type="password" 
                               name="password_confirmation" 
                               required autocomplete="new-password" placeholder="Confirm Password">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
                    </div>

                    <button class="w-40 font-[Poppins] bg-[#5ACD65] text-[#0D420F] font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                        Daftar
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
