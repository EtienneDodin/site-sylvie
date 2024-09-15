<x-app-layout>
    <x-slot name="header">
        Gestion des créations
    </x-slot>

    <div class="flex flex-col gap-6 items-center mt-4">
        <a href="{{ route('creations.create') }}">
            <h2 class="font-regular bg-gray-800 text-gray-100 hover:bg-gray-700 hover:shadow transition rounded-xl py-2 my-2 px-4 anek text-lg">
                Ajouter une création</h2>
        </a>

        <div class="flex flex-wrap justify-center gap-10 px-6">
            {{-- Cards --}}
            @foreach ($creations as $creation)
                <div class="bg-gray-50 flex flex-col gap-11 rounded-lg shadow py-6 px-16 items-center">
                    <div class="flex flex-col gap-4 items-center">

                        <div class="my-6 flex justify-center items-center w-80 h-60">
                            {{-- Display image if exists --}}
                            @if ($creation->images->count() > 0)

                                {{-- Select first image --}}
                                @php
                                    $image = $creation->images->first();
                                @endphp

                                {{-- display --}}
                                <img class="object-scale-down h-60" src="{{ $image->path }}" alt="{{ $creation->description }}">

                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="flex flex-col gap-3 items-center">
                            <p class="text-center font-semibold">{{ $creation->name }}</p>
                            <p class="text-center"><span>Vendu : </span>{{ $creation->sold ? 'Oui' : 'Non' }}</p>
                            <p class="text-center overflow-auto"><span class="font-semibold">Description</span> : {{ $creation->description }}</p>
                            <p class="text-center"><span class="underline underline-offset-2 decoration-slate-300">Dimensions</span> : {{ $creation->dimensions }}</p>
                            <p class="text-center">Galerie : {{ $creation->gallerymsg ? 'Oui' : 'Non' }}</p>
                            <p class="text-center">Prix : {{ $creation->price }}€</p>
                            <p class="text-center">
                                @foreach ($categories as $category)
                                    @if ($category->id === $creation->category_id)
                                        {{ $category->category }}
                                    @endif
                                @endforeach
                            </p>
                        </div>
                        
                    </div>

                    {{-- Buttons container --}}
                    <div class="flex flex-col gap-4">
                        {{-- Edit --}}
                        <div class="w-32 flex justify-center">
                            <a href="{{ route('creations.edit', $creation) }}"
                                class="rounded-md text-gray-200 py-1.5 bg-gray-600 hover:bg-gray-500 px-3">Modifier</a>
                        </div>

                        {{-- Delete --}}
                        <div class="w-32 flex justify-center">
                            <form action="{{ route('creations.destroy', $creation) }}" method="post" x-data="{ open: false }">
                                @method('DELETE')
                                @csrf
                                <button type="button" @click="open = true"
                                    class="rounded-md text-gray-200 py-1.5 bg-amber-700 hover:bg-amber-800 px-3">Supprimer</button>

                                {{-- Confirmation modal window --}}

                                {{-- Dark overlay --}}
                                <div x-show="open" x-cloak x-transition:enter.duration.200ms x-transition:leave.duration.200ms class="fixed top-0 left-0 w-full h-full bg-black/50"></div>
                                {{-- Container --}}
                                <div x-show="open" x-transition x-cloak class="fixed left-0 top-20 w-full h-full flex justify-center items-center">
                                    {{-- Modal --}}
                                    <div @click.outside="open = false" class="bg-gray-200 flex flex-col py-24 items-center gap-24 rounded border shadow z-[1] w-1/2">
                                        <p class="font-semibold text-3xl">Êtes-vous sûr de vouloir supprimer cette création ?</p>
                                        <div class="flex gap-20">
                                            <button type="submit"
                                            class="rounded-md text-gray-200 py-1.5 bg-amber-700 px-8">Oui</button>
                                            <button type="button" @click="open = false"
                                            class="rounded-md text-gray-200 py-1.5 bg-gray-600 px-8">Non</button>
                                        </div>
                                    </div>

                                </div>
                                
                            </form>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>
