<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Sylvie Buatois, Artiste créateur céramiste animalière raku, poterie, modelage, Besançon, mes créations">
    <meta name="author" content="Etienne Dodin">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=anek-malayalam:200,300,400,500|raleway:200,300,400,500"
        rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="bg-light-gray font-raleway" x-data>

    <header>
        <!-- Main nav -->
        <nav class="p-6 hidden lg:block">
            <ul class="flex justify-end items-center gap-5 pr-8 text-lg font-light">
                <li><a href="{{ route('index') }}"
                        class="relative pb-1 after:content-[''] after:absolute after:w-full after:h-px after:bottom-0 after:left-0 after:bg-[#838386] after:scale-0 after:transition duration-200 ease-out hover:after:scale-100 hover:text-gray-600">Accueil</a>
                </li>
                <li><a href="{{ route('work') }}"
                        class="relative pb-1 after:content-[''] after:absolute after:w-full after:h-px after:bottom-0 after:left-0 after:bg-[#838386] after:scale-0 after:transition duration-200 ease-out hover:after:scale-100 hover:text-gray-600">Mon
                        travail</a></li>
                <li><a href="{{ route('contact') }}"
                        class="relative pb-1 after:content-[''] after:absolute after:w-full after:h-px after:bottom-0 after:left-0 after:bg-[#838386] after:scale-0 after:transition duration-200 ease-out hover:after:scale-100 hover:text-gray-600">Me
                        contacter</a></li>
            </ul>
        </nav>

    </header>

    <div class="text-gray-900 antialiased">
        {{-- Burger menu --}}
        <div x-data="{ open: false }" class="sticky z-10 top-0">
            <!-- Icon -->
            <div class="lg:hidden h-28 bg-light-gray flex justify-center items-center">
                <svg @click="open = true" class="hover:cursor-pointer" width="70px" height="70px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12C22 7.28595 22 4.92893 20.5355 3.46447C19.0711 2 16.714 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355ZM18.75 16C18.75 16.4142 18.4142 16.75 18 16.75H6C5.58579 16.75 5.25 16.4142 5.25 16C5.25 15.5858 5.58579 15.25 6 15.25H18C18.4142 15.25 18.75 15.5858 18.75 16ZM18 12.75C18.4142 12.75 18.75 12.4142 18.75 12C18.75 11.5858 18.4142 11.25 18 11.25H6C5.58579 11.25 5.25 11.5858 5.25 12C5.25 12.4142 5.58579 12.75 6 12.75H18ZM18.75 8C18.75 8.41421 18.4142 8.75 18 8.75H6C5.58579 8.75 5.25 8.41421 5.25 8C5.25 7.58579 5.58579 7.25 6 7.25H18C18.4142 7.25 18.75 7.58579 18.75 8Z" fill="#000000"/>
                </svg>
            </div>

            <!-- Menu -->
            {{-- Dark opacity background --}}
            <div x-show="open" x-cloak x-transition.duration.100ms.origin.left
                    class="fixed z-10 top-0 left-0 w-full h-full bg-black/50"></div>

            <div x-show="open" x-cloak x-transition.duration.100ms.origin.left @click.outside="open = false"
                class="fixed top-0 z-10 flex flex-col gap-80 items-center bg-light-gray">
                {{-- Nav and footer --}}
                <div class="flex flex-col justify-around h-96 items-center gap-10">
                    <span @click="open = false" class="hover:cursor-pointer hover:rotate-90 transition duration-300 ease-in-out">
                        <svg width="60px" height="60px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 5L19 19M5 19L19 5" stroke="#000000" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                    <nav>
                        <ul class="flex flex-col text-center gap-10 text-xl">
                            <li><a href="{{ route('index') }}"
                                    class="relative pb-1 after:content-[''] after:absolute after:w-full after:h-px after:bottom-0 after:left-0 after:bg-[#838386] after:scale-0 after:transition duration-100 ease-out hover:after:scale-100">Accueil</a>
                            </li>
                            <li><a href="{{ route('work') }}"
                                    class="relative pb-1 after:content-[''] after:absolute after:w-full after:h-px after:bottom-0 after:left-0 after:bg-[#838386] after:scale-0 after:transition duration-100 ease-out hover:after:scale-100">Mon
                                    travail</a></li>
                            <li><a href="{{ route('contact') }}"
                                    class="relative pb-1 after:content-[''] after:absolute after:w-full after:h-px after:bottom-0 after:left-0 after:bg-[#838386] after:scale-0 after:transition duration-100 ease-out hover:after:scale-100">Me
                                    contacter</a></li>
                        </ul>
                    </nav>
                </div>

                <h3 class="text-sm text-center px-4 mb-7">© Tous droits réservés - Sylvie Buatois, céramiste Raku</h3>
            </div>
        </div>

        {{ $slot }}
    </div>

    <footer>
        <div class="bg-gradient-to-bl from-light-gray to-neutral-300 flex flex-col md:flex-row justify-around gap-10 p-14">
            <div>
                <ul class="text-gray-700 flex flex-col gap-4">
                    <li><a href="{{ route('index') }}">Accueil - Découvrez mes créations</a></li>
                    <li><a href="{{ route('work') }}">Mon travail</a></li>
                    <li><a href="{{ route('contact') }}">Contactez-moi</a></li>
                </ul>
            </div>
            <div>
                <ul class="text-gray-700 flex flex-col gap-4">
                    <li><a href="{{ route('legalnotice') }}">Mentions légales</a></li>
                    <li><a href="{{ route('privacypolicy') }}">Politique de confidentialité</a></li>
                    <li><a href="mailto:sylvie.buatois@laposte.net">sylvie.buatois@laposte.net</a></li>
                </ul>
            </div>
        </div>

    </footer>

    @livewireScripts
</body>

</html>
