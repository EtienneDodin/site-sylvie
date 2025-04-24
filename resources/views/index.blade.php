<x-guest-layout>
    <x-slot name="title">
        Sylvie Buatois - Artiste créateur céramiste raku
    </x-slot>

    <main>
        <div class="bg-neutral-200 flex flex-col lg:flex-row md:justify-around shadow-sm pb-4">
            <!-- Main headings -->
            <div class="flex flex-col items-center gap-16">
                <div class="flex flex-col gap-20 md:gap-28 p-8 items-center border-style">
                    {{-- Main title --}}
                    <h1 class="font-medium text-center text-7xl md:text-8xl mt-16 text-amber-900">Sylvie Buatois</h1>
                    <h2 class="font-medium text-center text-4xl">Artiste créateur, céramiste animalière raku</h2>
                    <a href="#creations">
                        <h2 class="text-2xl text-gray-900 underline decoration-light-orange underline-offset-8 hover:text-amber-800 transition duration-200 ease-in-out">
                            Découvrez mes créations
                        </h2>
                    </a>
                </div>

                <a href="{{ route('work') }}" class="mb-16 flex items-center">
                    <h2 class="text-2xl text-light-orange hover:text-gray-800 transition duration-200 ease-in-out font-normal pr-1">
                        Mon travail
                    </h2>
                    {{-- Arrow --}}
                    <span>
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 7L15 12L10 17" stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                </a>
            </div>

            <!-- Main picture -->
            <div class="flex flex-col items-center">
                <img src="./images/photo-sylvie.jpg" alt="photo de Sylvie Buatois" class="w-full xl:max-w-3xl mb-3">
                <p class="font-light">© Photographies Jack Varlet</p>
            </div>
        </div>

        <section id="creations" class="px-10 md:px-20">

            <!-- First slider -->
            <div class="flex flex-col items-center" x-data="{ open: false, modalContent: {} }">
                {{-- Title --}}
                <h3 class="font-semibold font-anek text-5xl pt-12 pb-10 md:pb-16">Les Ours</h3>
                <!-- Main + thumbs section -->
                <div class="flex flex-col w-screen items-center">
                    {{-- Main --}}
                    <div class="swiper w-full max-w-110" data-aos="fade-up" data-aos-duration="1000">
                        <div class="swiper-wrapper mb-12">
    
                            @foreach ($creations->reverse() as $creation)
                                @if ($creation->category_id === 1)
                                    @foreach ($creation->images as $image)
                                        {{-- Image display --}}
                                        <div class="swiper-slide">
    
                                            <div class="flex flex-col gap-6 items-center">
                                                {{-- Image --}}
                                                <div class="max-w-5xl max-h-80 md:max-h-slider-image">
                                                    <img src="{{ $image->path }}" alt="{{ $creation->description }}"
                                                        class="object-scale-down h-80 md:h-slider-image rounded-sm shadow-sm shadow-slate-300">
                                                </div>
    
                                                {{-- Vendu --}}
                                                <div class="flex gap-24 mb-3">
                                                    <p class="text-lg font-medium">Vendu :
                                                        {{ $creation->sold ? 'oui' : 'non' }}</p>
                                                    <p class="underline text-lg text-gray-700 hover:text-gray-500 transition duration-200 ease-in-out hover:cursor-pointer"
                                                        @click="open = true; modalContent = { image: '{{ $image->path }}', description: '{{ $creation->description }}', dimensions: '{{ $creation->dimensions ? 'Cette création mesure ' . $creation->dimensions : '' }}', price: '{{ $creation->price ? 'Prix de la création : ' . $creation->price . ' €' : '' }}', sold: 'Vendu : {{ $creation->sold ? 'oui' : 'non' }}', saleStatus: '{{ !$creation->sold ? ($creation->gallerymsg ? 'Cette pièce est actuellement exposée en galerie.' : 'Cette pièce est disponible.') : '' }}'  }">
                                                        En savoir plus</p>
                                                </div>
                                            </div>
    
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
    
                        </div>
                        
                        <div class="swiper-pagination"></div>

                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        
                    </div>
    
                    <!-- Thumbs -->
                    <div thumbsSlider="" class="mySwiper w-full py-6">
                        <div class="swiper-wrapper flex justify-center flex-wrap gap-y-0.5">
    
                            @foreach ($creations->reverse() as $creation)
                                @if ($creation->category_id === 1)
                                    @foreach ($creation->images as $image)

                                        <div class="swiper-slide max-w-20 overflow-hidden flex justify-center items-center h-14">
                                            <img src="{{ $image->path }}" alt="{{ $creation->description }}"
                                                class="w-full h-14 object-cover rounded-sm">
                                        </div>

                                    @endforeach
                                @endif
                            @endforeach
    
                        </div>
                    </div>

                </div>
                
                <!-- Modal Window -->
                {{-- Dark opacity background --}}
                <div x-show="open" x-cloak x-transition:enter.duration.200ms x-transition:leave.duration.200ms
                    class="fixed z-10 top-0 left-0 w-full h-full bg-black/50"></div>

                <div x-show="open" x-cloak x-transition:enter.duration.300ms x-transition:leave.duration.300ms class="fixed z-10 top-0 left-0 w-full h-full flex justify-center items-center">

                    <div @click.outside="open = false" class="flex flex-col items-center gap-10 bg-gray-200 shadow-md py-10 px-4 mb-2 w-5/6 lg:w-2/5 z-10 rounded-lg">

                        {{-- Close --}}
                        <div class="flex justify-start border p-px border-gray-300 bg-gray-100/75 hover:bg-gray-200 transition duration-300 ease-in-out rounded-lg">
                            <span @click="open = false">
                                <svg class="opacity-55 hover:cursor-pointer transition duration-300 ease-in-out" width="40px" height="40px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 5L19 19M5 19L19 5" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </div>

                        <!-- Info about creation -->
                        <div class="w-full">
                            <div class="flex flex-col items-center gap-8">

                                {{-- Image --}}
                                <div class="w-5/6 md:max-w-lg max-h-48 md:max-h-80 flex justify-center">
                                    <img :src="modalContent.image" :alt="modalContent.description"
                                    class="h-48 md:h-80 object-scale-down shadow-sm border">
                                </div>

                                {{-- Text --}}
                                <div class="flex flex-col gap-3 items-center">
                                    <p x-text="modalContent.description" class="text-center text-lg font-semibold"></p>
                                    <p x-text="modalContent.sold" class="text-center text-lg"></p>
                                    <p x-text="modalContent.price" class="text-center text-lg"></p>
                                    <p x-text="modalContent.saleStatus" class="text-center text-lg"></p>
                                    <p x-text="modalContent.dimensions" class="text-center text-lg"></p>
                                </div>
    
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Second slider -->
            <div class="flex flex-col items-center" x-data="{ open: false, modalContent: {} }">
                {{-- Title --}}
                <h3 class="font-semibold font-anek text-5xl pt-12 pb-10 md:pb-16">Les Oiseaux</h3>
                <!-- Main + thumbs section -->
                <div class="flex flex-col w-screen items-center">
                    {{-- Main --}}
                    <div class="swiper w-full max-w-110" data-aos="fade-right" data-aos-offset="-300" data-aos-duration="1000">
                        <div class="swiper-wrapper mb-12">
    
                            @foreach ($creations->reverse() as $creation)
                                @if ($creation->category_id === 2)
                                    @foreach ($creation->images as $image)
                                        {{-- Image display --}}
                                        <div class="swiper-slide">
    
                                            <div class="flex flex-col gap-6 items-center">
                                                {{-- Image --}}
                                                <div class="max-w-5xl max-h-80 md:max-h-slider-image">
                                                    <img src="{{ $image->path }}" alt="{{ $creation->description }}"
                                                        class="object-scale-down h-80 md:h-slider-image rounded-sm shadow-sm shadow-slate-300">
                                                </div>
    
                                                {{-- Vendu --}}
                                                <div class="flex gap-24 mb-3">
                                                    <p class="text-lg font-medium">Vendu :
                                                        {{ $creation->sold ? 'oui' : 'non' }}</p>
                                                    <p class="underline text-lg text-gray-700 hover:text-gray-500 transition duration-200 ease-in-out hover:cursor-pointer"
                                                        @click="open = true; modalContent = { image: '{{ $image->path }}', description: '{{ $creation->description }}', dimensions: '{{ $creation->dimensions ? 'Cette création mesure ' . $creation->dimensions : '' }}', price: '{{ $creation->price ? 'Prix de la création : ' . $creation->price . ' €' : '' }}', sold: 'Vendu : {{ $creation->sold ? 'oui' : 'non' }}', saleStatus: '{{ !$creation->sold ? ($creation->gallerymsg ? 'Cette pièce est actuellement exposée en galerie.' : 'Cette pièce est disponible.') : '' }}'  }">
                                                        En savoir plus</p>
                                                </div>
                                            </div>
    
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
    
                        </div>
                        
                        <div class="swiper-pagination"></div>

                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        
                    </div>
    
                    <!-- Thumbs -->
                    <div thumbsSlider="" class="mySwiper w-full py-6">
                        <div class="swiper-wrapper flex justify-center flex-wrap gap-y-0.5">
    
                            @foreach ($creations->reverse() as $creation)
                                @if ($creation->category_id === 2)
                                    @foreach ($creation->images as $image)

                                        <div class="swiper-slide max-w-20 overflow-hidden flex justify-center items-center h-14">
                                            <img src="{{ $image->path }}" alt="{{ $creation->description }}"
                                                class="w-full h-14 object-cover rounded-sm">
                                        </div>

                                    @endforeach
                                @endif
                            @endforeach
    
                        </div>
                    </div>

                </div>
                
                <!-- Modal Window -->
                {{-- Dark opacity background --}}
                <div x-show="open" x-cloak x-transition:enter.duration.200ms x-transition:leave.duration.200ms
                    class="fixed z-10 top-0 left-0 w-full h-full bg-black/50"></div>

                <div x-show="open" x-cloak x-transition:enter.duration.300ms x-transition:leave.duration.300ms class="fixed z-10 top-0 left-0 w-full h-full flex justify-center items-center">

                    <div @click.outside="open = false" class="flex flex-col items-center gap-10 bg-gray-200 shadow-md py-10 px-4 mb-2 w-5/6 lg:w-2/5 z-10 rounded-lg">

                        {{-- Close --}}
                        <div class="flex justify-start border p-px border-gray-300 bg-gray-100/75 hover:bg-gray-200 transition duration-300 ease-in-out rounded-lg">
                            <span @click="open = false">
                                <svg class="opacity-55 hover:cursor-pointer transition duration-300 ease-in-out" width="40px" height="40px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 5L19 19M5 19L19 5" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </div>

                        <!-- Info about creation -->
                        <div class="w-full">
                            <div class="flex flex-col items-center gap-8">

                                {{-- Image --}}
                                <div class="w-5/6 md:max-w-lg max-h-48 md:max-h-80 flex justify-center">
                                    <img :src="modalContent.image" :alt="modalContent.description"
                                    class="h-48 md:h-80 object-scale-down shadow-sm border">
                                </div>

                                {{-- Text --}}
                                <div class="flex flex-col gap-3 items-center">
                                    <p x-text="modalContent.description" class="text-center text-lg font-semibold"></p>
                                    <p x-text="modalContent.sold" class="text-center text-lg"></p>
                                    <p x-text="modalContent.price" class="text-center text-lg"></p>
                                    <p x-text="modalContent.saleStatus" class="text-center text-lg"></p>
                                    <p x-text="modalContent.dimensions" class="text-center text-lg"></p>
                                </div>
    
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Third slider -->
            <div class="flex flex-col items-center" x-data="{ open: false, modalContent: {} }">
                {{-- Title --}}
                <h3 class="font-semibold font-anek text-5xl pt-12 pb-10 md:pb-16">Les Marins</h3>
                <!-- Main + thumbs section -->
                <div class="flex flex-col w-screen items-center">
                    {{-- Main --}}
                    <div class="swiper w-full max-w-110">
                        <div class="swiper-wrapper mb-12">
    
                            @foreach ($creations->reverse() as $creation)
                                @if ($creation->category_id === 3)
                                    @foreach ($creation->images as $image)
                                        {{-- Image display --}}
                                        <div class="swiper-slide">
    
                                            <div class="flex flex-col gap-6 items-center">
                                                {{-- Image --}}
                                                <div class="max-w-5xl max-h-80 md:max-h-slider-image">
                                                    <img src="{{ $image->path }}" alt="{{ $creation->description }}"
                                                        class="object-scale-down h-80 md:h-slider-image rounded-sm shadow-sm shadow-slate-300">
                                                </div>
    
                                                {{-- Vendu --}}
                                                <div class="flex gap-24 mb-3">
                                                    <p class="text-lg font-medium">Vendu :
                                                        {{ $creation->sold ? 'oui' : 'non' }}</p>
                                                    <p class="underline text-lg text-gray-700 hover:text-gray-500 transition duration-200 ease-in-out hover:cursor-pointer"
                                                        @click="open = true; modalContent = { image: '{{ $image->path }}', description: '{{ $creation->description }}', dimensions: '{{ $creation->dimensions ? 'Cette création mesure ' . $creation->dimensions : '' }}', price: '{{ $creation->price ? 'Prix de la création : ' . $creation->price . ' €' : '' }}', sold: 'Vendu : {{ $creation->sold ? 'oui' : 'non' }}', saleStatus: '{{ !$creation->sold ? ($creation->gallerymsg ? 'Cette pièce est actuellement exposée en galerie.' : 'Cette pièce est disponible.') : '' }}'  }">
                                                        En savoir plus</p>
                                                </div>
                                            </div>
    
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
    
                        </div>
                        
                        <div class="swiper-pagination"></div>

                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        
                    </div>
    
                    <!-- Thumbs -->
                    <div thumbsSlider="" class="mySwiper w-full py-6">
                        <div class="swiper-wrapper flex justify-center flex-wrap gap-y-0.5">
    
                            @foreach ($creations->reverse() as $creation)
                                @if ($creation->category_id === 3)
                                    @foreach ($creation->images as $image)

                                        <div class="swiper-slide max-w-20 overflow-hidden flex justify-center items-center h-14">
                                            <img src="{{ $image->path }}" alt="{{ $creation->description }}"
                                                class="w-full h-14 object-cover rounded-sm">
                                        </div>

                                    @endforeach
                                @endif
                            @endforeach
    
                        </div>
                    </div>

                </div>
                
                <!-- Modal Window -->
                {{-- Dark opacity background --}}
                <div x-show="open" x-cloak x-transition:enter.duration.200ms x-transition:leave.duration.200ms
                    class="fixed z-10 top-0 left-0 w-full h-full bg-black/50"></div>

                <div x-show="open" x-cloak x-transition:enter.duration.300ms x-transition:leave.duration.300ms class="fixed z-10 top-0 left-0 w-full h-full flex justify-center items-center">

                    <div @click.outside="open = false" class="flex flex-col items-center gap-10 bg-gray-200 shadow-md py-10 px-4 mb-2 w-5/6 lg:w-2/5 z-10 rounded-lg">

                        {{-- Close --}}
                        <div class="flex justify-start border p-px border-gray-300 bg-gray-100/75 hover:bg-gray-200 transition duration-300 ease-in-out rounded-lg">
                            <span @click="open = false">
                                <svg class="opacity-55 hover:cursor-pointer transition duration-300 ease-in-out" width="40px" height="40px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 5L19 19M5 19L19 5" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </div>

                        <!-- Info about creation -->
                        <div class="w-full">
                            <div class="flex flex-col items-center gap-8">

                                {{-- Image --}}
                                <div class="w-5/6 md:max-w-lg max-h-48 md:max-h-80 flex justify-center">
                                    <img :src="modalContent.image" :alt="modalContent.description"
                                    class="h-48 md:h-80 object-scale-down shadow-sm border">
                                </div>

                                {{-- Text --}}
                                <div class="flex flex-col gap-3 items-center">
                                    <p x-text="modalContent.description" class="text-center text-lg font-semibold"></p>
                                    <p x-text="modalContent.sold" class="text-center text-lg"></p>
                                    <p x-text="modalContent.price" class="text-center text-lg"></p>
                                    <p x-text="modalContent.saleStatus" class="text-center text-lg"></p>
                                    <p x-text="modalContent.dimensions" class="text-center text-lg"></p>
                                </div>
    
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Animaux des sous-bois -->
            <div class="flex flex-col items-center" x-data="{ open: false, modalContent: {} }">
                {{-- Title --}}
                <h3 class="font-semibold font-anek text-5xl text-center pt-12 pb-10 md:pb-16">Les Animaux des sous-bois</h3>
                <!-- Main + thumbs section -->
                <div class="flex flex-col w-screen items-center">
                    {{-- Main --}}
                    <div class="swiper w-full max-w-110" data-aos="fade-up" data-aos-offset="-300" data-aos-duration="1000">
                        <div class="swiper-wrapper mb-12">
    
                            @foreach ($creations->reverse() as $creation)
                                @if ($creation->category_id === 4)
                                    @foreach ($creation->images as $image)
                                        {{-- Image display --}}
                                        <div class="swiper-slide">
    
                                            <div class="flex flex-col gap-6 items-center">
                                                {{-- Image --}}
                                                <div class="max-w-5xl max-h-80 md:max-h-slider-image">
                                                    <img src="{{ $image->path }}" alt="{{ $creation->description }}"
                                                        class="object-scale-down h-80 md:h-slider-image rounded-sm shadow-sm shadow-slate-300">
                                                </div>
    
                                                {{-- Vendu --}}
                                                <div class="flex gap-24 mb-3">
                                                    <p class="text-lg font-medium">Vendu :
                                                        {{ $creation->sold ? 'oui' : 'non' }}</p>
                                                    <p class="underline text-lg text-gray-700 hover:text-gray-500 transition duration-200 ease-in-out hover:cursor-pointer"
                                                        @click="open = true; modalContent = { image: '{{ $image->path }}', description: '{{ $creation->description }}', dimensions: '{{ $creation->dimensions ? 'Cette création mesure ' . $creation->dimensions : '' }}', price: '{{ $creation->price ? 'Prix de la création : ' . $creation->price . ' €' : '' }}', sold: 'Vendu : {{ $creation->sold ? 'oui' : 'non' }}', saleStatus: '{{ !$creation->sold ? ($creation->gallerymsg ? 'Cette pièce est actuellement exposée en galerie.' : 'Cette pièce est disponible.') : '' }}'  }">
                                                        En savoir plus</p>
                                                </div>
                                            </div>
    
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
    
                        </div>
                        
                        <div class="swiper-pagination"></div>

                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        
                    </div>
    
                    <!-- Thumbs -->
                    <div thumbsSlider="" class="mySwiper w-full py-6">
                        <div class="swiper-wrapper flex justify-center flex-wrap gap-y-0.5">
    
                            @foreach ($creations->reverse() as $creation)
                                @if ($creation->category_id === 4)
                                    @foreach ($creation->images as $image)

                                        <div class="swiper-slide max-w-20 overflow-hidden flex justify-center items-center h-14">
                                            <img src="{{ $image->path }}" alt="{{ $creation->description }}"
                                                class="w-full h-14 object-cover rounded-sm">
                                        </div>

                                    @endforeach
                                @endif
                            @endforeach
    
                        </div>
                    </div>

                </div>
                
                <!-- Modal Window -->
                {{-- Dark opacity background --}}
                <div x-show="open" x-cloak x-transition:enter.duration.200ms x-transition:leave.duration.200ms
                    class="fixed z-10 top-0 left-0 w-full h-full bg-black/50"></div>

                <div x-show="open" x-cloak x-transition:enter.duration.300ms x-transition:leave.duration.300ms class="fixed z-10 top-0 left-0 w-full h-full flex justify-center items-center">

                    <div @click.outside="open = false" class="flex flex-col items-center gap-10 bg-gray-200 shadow-md py-10 px-4 mb-2 w-5/6 lg:w-2/5 z-10 rounded-lg">

                        {{-- Close --}}
                        <div class="flex justify-start border p-px border-gray-300 bg-gray-100/75 hover:bg-gray-200 transition duration-300 ease-in-out rounded-lg">
                            <span @click="open = false">
                                <svg class="opacity-55 hover:cursor-pointer transition duration-300 ease-in-out" width="40px" height="40px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 5L19 19M5 19L19 5" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </div>

                        <!-- Info about creation -->
                        <div class="w-full">
                            <div class="flex flex-col items-center gap-8">

                                {{-- Image --}}
                                <div class="w-5/6 md:max-w-lg max-h-48 md:max-h-80 flex justify-center">
                                    <img :src="modalContent.image" :alt="modalContent.description"
                                    class="h-48 md:h-80 object-scale-down shadow-sm border">
                                </div>

                                {{-- Text --}}
                                <div class="flex flex-col gap-3 items-center">
                                    <p x-text="modalContent.description" class="text-center text-lg font-semibold"></p>
                                    <p x-text="modalContent.sold" class="text-center text-lg"></p>
                                    <p x-text="modalContent.price" class="text-center text-lg"></p>
                                    <p x-text="modalContent.saleStatus" class="text-center text-lg"></p>
                                    <p x-text="modalContent.dimensions" class="text-center text-lg"></p>
                                </div>
    
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Exotiques -->
            <div class="flex flex-col items-center mb-16" x-data="{ open: false, modalContent: {} }">
                {{-- Title --}}
                <h3 class="font-semibold font-anek text-5xl text-center pt-12 pb-10 md:pb-16">Les Exotiques</h3>
                <!-- Main + thumbs section -->
                <div class="flex flex-col w-screen items-center">
                    {{-- Main --}}
                    <div class="swiper w-full max-w-110">
                        <div class="swiper-wrapper mb-12">
    
                            @foreach ($creations->reverse() as $creation)
                                @if ($creation->category_id === 5)
                                    @foreach ($creation->images as $image)
                                        {{-- Image display --}}
                                        <div class="swiper-slide">
    
                                            <div class="flex flex-col gap-6 items-center">
                                                {{-- Image --}}
                                                <div class="max-w-5xl max-h-80 md:max-h-slider-image">
                                                    <img src="{{ $image->path }}" alt="{{ $creation->description }}"
                                                        class="object-scale-down h-80 md:h-slider-image rounded-sm shadow-sm shadow-slate-300">
                                                </div>
    
                                                {{-- Vendu --}}
                                                <div class="flex gap-24 mb-3">
                                                    <p class="text-lg font-medium">Vendu :
                                                        {{ $creation->sold ? 'oui' : 'non' }}</p>
                                                    <p class="underline text-lg text-gray-700 hover:text-gray-500 transition duration-200 ease-in-out hover:cursor-pointer"
                                                        @click="open = true; modalContent = { image: '{{ $image->path }}', description: '{{ $creation->description }}', dimensions: '{{ $creation->dimensions ? 'Cette création mesure ' . $creation->dimensions : '' }}', price: '{{ $creation->price ? 'Prix de la création : ' . $creation->price . ' €' : '' }}', sold: 'Vendu : {{ $creation->sold ? 'oui' : 'non' }}', saleStatus: '{{ !$creation->sold ? ($creation->gallerymsg ? 'Cette pièce est actuellement exposée en galerie.' : 'Cette pièce est disponible.') : '' }}'  }">
                                                        En savoir plus</p>
                                                </div>
                                            </div>
    
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
    
                        </div>
                        
                        <div class="swiper-pagination"></div>

                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        
                    </div>
    
                    <!-- Thumbs -->
                    <div thumbsSlider="" class="mySwiper w-full py-6">
                        <div class="swiper-wrapper flex justify-center flex-wrap gap-y-0.5">
    
                            @foreach ($creations->reverse() as $creation)
                                @if ($creation->category_id === 5)
                                    @foreach ($creation->images as $image)

                                        <div class="swiper-slide max-w-20 overflow-hidden flex justify-center items-center h-14">
                                            <img src="{{ $image->path }}" alt="{{ $creation->description }}"
                                                class="w-full h-14 object-cover rounded-sm">
                                        </div>

                                    @endforeach
                                @endif
                            @endforeach
    
                        </div>
                    </div>
                </div>
                
                <!-- Modal Window -->
                {{-- Dark opacity background --}}
                <div x-show="open" x-cloak x-transition:enter.duration.200ms x-transition:leave.duration.200ms
                    class="fixed z-10 top-0 left-0 w-full h-full bg-black/50"></div>

                <div x-show="open" x-cloak x-transition:enter.duration.300ms x-transition:leave.duration.300ms class="fixed z-10 top-0 left-0 w-full h-full flex justify-center items-center">

                    <div @click.outside="open = false" class="flex flex-col items-center gap-10 bg-gray-200 shadow-md py-10 px-4 mb-2 w-5/6 lg:w-2/5 z-10 rounded-lg">

                        {{-- Close --}}
                        <div class="flex justify-start border p-px border-gray-300 bg-gray-100/75 hover:bg-gray-200 transition duration-300 ease-in-out rounded-lg">
                            <span @click="open = false">
                                <svg class="opacity-55 hover:cursor-pointer transition duration-300 ease-in-out" width="40px" height="40px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 5L19 19M5 19L19 5" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </div>

                        <!-- Info about creation -->
                        <div class="w-full">
                            <div class="flex flex-col items-center gap-8">

                                {{-- Image --}}
                                <div class="w-5/6 md:max-w-lg max-h-48 md:max-h-80 flex justify-center">
                                    <img :src="modalContent.image" :alt="modalContent.description"
                                    class="h-48 md:h-80 object-scale-down shadow-sm border">
                                </div>

                                {{-- Text --}}
                                <div class="flex flex-col gap-3 items-center">
                                    <p x-text="modalContent.description" class="text-center text-lg font-semibold"></p>
                                    <p x-text="modalContent.sold" class="text-center text-lg"></p>
                                    <p x-text="modalContent.price" class="text-center text-lg"></p>
                                    <p x-text="modalContent.saleStatus" class="text-center text-lg"></p>
                                    <p x-text="modalContent.dimensions" class="text-center text-lg"></p>
                                </div>
    
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Les Animaux de nos maisons -->
            <div class="flex flex-col items-center mb-16" x-data="{ open: false, modalContent: {} }">
                {{-- Title --}}
                <h3 class="font-semibold font-anek text-5xl text-center pt-12 pb-10 md:pb-16">Les Animaux de nos maisons</h3>
                <!-- Main + thumbs section -->
                <div class="flex flex-col w-screen items-center">
                    {{-- Main --}}
                    <div class="swiper w-full max-w-110">
                        <div class="swiper-wrapper mb-12">
    
                            @foreach ($creations->reverse() as $creation)
                                @if ($creation->category_id === 6)
                                    @foreach ($creation->images as $image)
                                        {{-- Image display --}}
                                        <div class="swiper-slide">
    
                                            <div class="flex flex-col gap-6 items-center">
                                                {{-- Image --}}
                                                <div class="max-w-5xl max-h-80 md:max-h-slider-image">
                                                    <img src="{{ $image->path }}" alt="{{ $creation->description }}"
                                                        class="object-scale-down h-80 md:h-slider-image rounded-sm shadow-sm shadow-slate-300">
                                                </div>
    
                                                {{-- Vendu --}}
                                                <div class="flex gap-24 mb-3">
                                                    <p class="text-lg font-medium">Vendu :
                                                        {{ $creation->sold ? 'oui' : 'non' }}</p>
                                                    <p class="underline text-lg text-gray-700 hover:text-gray-500 transition duration-200 ease-in-out hover:cursor-pointer"
                                                        @click="open = true; modalContent = { image: '{{ $image->path }}', description: '{{ $creation->description }}', dimensions: '{{ $creation->dimensions ? 'Cette création mesure ' . $creation->dimensions : '' }}', price: '{{ $creation->price ? 'Prix de la création : ' . $creation->price . ' €' : '' }}', sold: 'Vendu : {{ $creation->sold ? 'oui' : 'non' }}', saleStatus: '{{ !$creation->sold ? ($creation->gallerymsg ? 'Cette pièce est actuellement exposée en galerie.' : 'Cette pièce est disponible.') : '' }}'  }">
                                                        En savoir plus</p>
                                                </div>
                                            </div>
    
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
    
                        </div>
                        
                        <div class="swiper-pagination"></div>

                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        
                    </div>
    
                    <!-- Thumbs -->
                    <div thumbsSlider="" class="mySwiper w-full py-6">
                        <div class="swiper-wrapper flex justify-center flex-wrap gap-y-0.5">
    
                            @foreach ($creations->reverse() as $creation)
                                @if ($creation->category_id === 6)
                                    @foreach ($creation->images as $image)

                                        <div class="swiper-slide max-w-20 overflow-hidden flex justify-center items-center h-14">
                                            <img src="{{ $image->path }}" alt="{{ $creation->description }}"
                                                class="w-full h-14 object-cover rounded-sm">
                                        </div>

                                    @endforeach
                                @endif
                            @endforeach
    
                        </div>
                    </div>
                </div>
                
                <!-- Modal Window -->
                <div x-show="open" x-cloak x-transition:enter.duration.200ms x-transition:leave.duration.200ms
                    class="fixed z-10 top-0 left-0 w-full h-full bg-black/50"></div>

                <div x-show="open" x-cloak x-transition:enter.duration.300ms x-transition:leave.duration.300ms class="fixed z-10 top-0 left-0 w-full h-full flex justify-center items-center">

                    <div @click.outside="open = false" class="flex flex-col items-center gap-10 bg-gray-200 shadow-md py-10 px-4 mb-2 w-5/6 lg:w-2/5 z-10 rounded-lg">

                        {{-- Close --}}
                        <div class="flex justify-start border p-px border-gray-300 bg-gray-100/75 hover:bg-gray-200 transition duration-300 ease-in-out rounded-lg">
                            <span @click="open = false">
                                <svg class="opacity-55 hover:cursor-pointer transition duration-300 ease-in-out" width="40px" height="40px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 5L19 19M5 19L19 5" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </div>

                        <!-- Info about creation -->
                        <div class="w-full">
                            <div class="flex flex-col items-center gap-8">

                                {{-- Image --}}
                                <div class="w-5/6 md:max-w-lg max-h-48 md:max-h-80 flex justify-center">
                                    <img :src="modalContent.image" :alt="modalContent.description"
                                    class="h-48 md:h-80 object-scale-down shadow-sm border">
                                </div>

                                {{-- Text --}}
                                <div class="flex flex-col gap-3 items-center">
                                    <p x-text="modalContent.description" class="text-center text-lg font-semibold"></p>
                                    <p x-text="modalContent.sold" class="text-center text-lg"></p>
                                    <p x-text="modalContent.price" class="text-center text-lg"></p>
                                    <p x-text="modalContent.saleStatus" class="text-center text-lg"></p>
                                    <p x-text="modalContent.dimensions" class="text-center text-lg"></p>
                                </div>
    
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </section>
    </main>

</x-guest-layout>
