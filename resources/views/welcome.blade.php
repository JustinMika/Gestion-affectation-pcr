<!doctype html>
<html lang="fr" class="dark">
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Connectez-vous à la plateforme</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('cdn/css/app.css') }}">
    <link rel="icon" type="image/png" href="{{ asset("images/hospital_unigom.png") }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <script>
        try {
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark')
            }
        } catch (error) {
            console.error(error)
        }

    </script>
</head>

<body class="bg-gray-50 dark:bg-gray-800">
<main class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
        <a href="/" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
        </a>
        <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Connectez-vous à la plateforme
            </h2>
            <form class="mt-8 space-y-6" action="{{ route('login-admin') }}" method="POST">
                @csrf
                <div>
                    <label for="email"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" name="email" id="email"
                           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                           placeholder="pseudo@domaine.com" required>
                    @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="Motdepasse" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mot de
                        passe</label>
                    <input type="password" name="password" id="password" placeholder="•••••••••"
                           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                           required>
                    @error('password')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                @if (Session::has('failed-login'))
                    <div class="p-2 text-red-500 bg-emerald-300 rounded-md" role="alert">
                        <strong>{{ Session::get('failed-login') }}</strong>
                    </div>
                @endif

                <button type="submit"
                        class="w-full px-5 py-3 text-base font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto md:w-full lg:w-full dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    Se connecter
                </button>
            </form>
        </div>
    </div>
</main>

@includeIf('partials.link-footer')
</body>

</html>
