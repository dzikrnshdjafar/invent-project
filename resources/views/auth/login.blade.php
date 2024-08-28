<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            <div class="p-56">
                <h2 class="text-4xl font-bold mb-8 font-[Poppins]">Masuk</h2>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-lg mb-2 font-[Nunito]" for="email">Email</label>
                        <input class="w-full px-4 py-2 text-black bg-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" 
                               id="email" 
                               type="email" 
                               name="email" 
                               :value="old('email')" 
                               required 
                               autofocus 
                               placeholder="Email"
                               autocomplete="username">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                    </div>
                    <div class="mb-6">
                        <label class="block text-lg mb-2 font-[Nunito]" for="password">Password</label>
                        <input class="w-full px-4 py-2 text-black bg-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" 
                               id="password" 
                               type="password" 
                               name="password" 
                               required 
                               placeholder="Password" 
                               autocomplete="current-password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                    </div>
                    <div class="flex items-center justify-between mb-6">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-green-400" name="remember">
                            <span class="ml-2 text-sm font-[Nunito]">{{ __('Remember me') }}</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-[Nunito] text-white underline">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                    <button class="w-40 font-[Poppins] bg-[#5ACD65] text-[#0D420F] font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                        {{ __('Log in') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
