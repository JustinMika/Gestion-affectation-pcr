<!doctype html>
<html lang="fr" class="dark">

<meta http-equiv="content-type" content="text/html;charset=utf-8"/>

<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Profil - Gestion des agents</title>
	<link rel="stylesheet" href="{{ asset('cdn/css/app.css') }}">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="theme-color" content="#ffffff">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=SUSE:wght@100..800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet"/>

    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.2.4/themes/blue/pace-theme-flash.min.css"
          integrity="sha512-hPHdudSZUyxoMNAYUu8c/2BDg1ah3tCtdhFwWTUN4qI8Y5emCPVKwyR1tJXhL/uBx7x7MYKGvc1TbdH6mwGS8Q=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script>
        window.paceOptions = {
            ajax: true
            , element: true
        }
    </script>

    <style>
        body::-webkit-scrollbar {
            width: 8px;
        }

        body::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        }

        body::-webkit-scrollbar-thumb {
            background-color: #f6f9ff;
            outline: 1px solid rgb(105, 147, 189);
            border-radius: 8px;
        }

        #trix-toolbar-1 {
            min-height: 190% !important;
            height: 190% !important;
            max-height: 190% !important;
        }

        /* sidebar scrollbar */
        #sidebar::-webkit-scrollbar {
            width: 3px impotant;
            background-color: rgba(65, 65, 77, 0.4)
        }

        #sidebar::-webkit-scrollbar-thumb {
            background-color: #f6f9ff;
            outline: 1px solid rgb(105, 147, 189);
            border-radius: 8px;
        }

        #sidebar::-moz-scrollbar-thumb {
            /* For Mozilla Firefox */
            background-color: #f6f9ff;
            outline: 1px solid rgb(105, 147, 189);
            border-radius: 8px;
        }

        #sidebar::-ms-scrollbar-thumb {
            /* For Internet Explorer */
            background-color: #f6f9ff;
            outline: 1px solid rgb(105, 147, 189);
            border-radius: 8px;
        }

    </style>


    <style>
        * {
            font-family: "SUSE", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }
    </style>
	<script>
		if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
			document.documentElement.classList.add('dark');
		} else {
			document.documentElement.classList.remove('dark')
		}
	</script>
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
	<link rel="stylesheet" href="{{ asset('cdn/css/sweetalert2.min.css') }}">
	<script src="{{ asset('cdn/js/sweetalert2@11.js') }}"></script>
	@livewireStyles
</head>

<body class="bg-gray-50 dark:bg-gray-800">
{{-- nav --}}
@includeIf("partials.nav")
<div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
	{{-- sidebar --}}
	@include('partials.sidebar')
	<div id="main-content" class="relative w-full h-full overflow-y-auto bg-slate-50 lg:ml-64 dark:bg-gray-900">
		<main>
			<div class="px-4 pt-6 spacing-y-4 gap-4">
				@include('partials.breadcump', ['titre' => "", 'titre2' => ""])
				{{ $slot }}
			</div>
		</main>
		<p class="my-10 text-sm text-center text-gray-500">
			&copy; 2024-{{ date("Y") }} <a href="#" class=" hover:underline" target="#">Gestion des agents</a>. All rights reserved.
		</p>
	</div>
</div>
@livewireScripts
@includeIf('partials.link-footer')
</body>

</html>

