<x-app-layout>
    <x-slot name="header">
        Modifier une création
    </x-slot>
    <div class="flex flex-col gap-14 my-4 items-center">
        {{-- Main edit section --}}
        <div class="flex gap-8 justify-center items-center">

            <form action="{{ route('creations.update', $creation) }}" method="post" class="flex mt-12 gap-32 items-center" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="mt-2 flex flex-col items-center gap-7">

                    <div class="flex flex-col gap-4 items-center">
                        <label for="name">Nom de la création</label>
                        <input type="text" name="name" id="name" value="{{ $creation->name }}"
                            class="rounded border-gray-300">
                    </div>

                    <div class="flex gap-4 items-center">
                        <label for="sold">Création vendue ?</label>
                        <input type="hidden" name="sold" value="0">
                        <input type="checkbox" name="sold" id="sold" value="1">
                    </div>

                    <div class="flex flex-col gap-4 items-center">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" maxlength="255" class="rounded text-left text-gray-800 w-64 h-24 border-gray-300">{{ $creation->description }}</textarea>
                    </div>

                    <div class="flex flex-col gap-4 items-center">
                        <label for="dimensions">Dimensions</label>
                        <input type="text" id="dimensions" name="dimensions" value="{{ $creation->dimensions }}"
                            class="rounded border-gray-300">
                    </div>

                    <div class="flex gap-4 items-center">
                        <label for="gallerymsg">Est-elle en galerie ?</label>
                        <input type="hidden" name="gallerymsg" value="0">
                        <input type="checkbox" id="gallerymsg" name="gallerymsg" value="1">
                    </div>

                    <div class="flex flex-col gap-4 items-center">
                        <label for="price">Prix</label>
                        <input type="text" id="price" name="price" value="{{ $creation->price }}"
                            class="rounded border-gray-300">
                    </div>

                    <div class="flex flex-col gap-4 items-center">
                        <label for="category_id">Catégorie</label>

                        <select name="category_id" id="category_id" class="rounded border-gray-300">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $creation->category_id ? 'selected' : '' }}>{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="rounded-md mt-8 border py-1.5 px-3 bg-blue-200 hover:bg-blue-300 hover:border-gray-700 transition duration-200 ease-in-out">Mettre à jour</button>
                </div>

                {{-- Pictures --}}
                <div class="flex flex-col items-center gap-8">
                    <h2 class="font-semibold">Images actuelles</h2>
                    <div class="flex">
                        @foreach ($creation->images as $image)
                            <div class="flex flex-col gap-8">
                                <img src="{{ $image->path }}" alt="{{ $creation->description }}" class="max-w-24">
                                <label for="image">Remplacer l'image</label>
                                <input type="file" id="image" name="image" accept="image/*">
                                {{-- <button type="submit" class="rounded-md text-gray-100 bg-amber-600 hover:bg-amber-700 transition duration-200 ease-in-out text-sm px-3 py-1.5">Remplacer l'image</button> --}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </form>

        </div>

        {{-- Add new image --}}
        <form action="{{ route('images.store', $creation) }}" method="post" enctype="multipart/form-data" x-data="{ imagePreview: '' }">
            @csrf
            {{-- {{ dump($creation) }} --}}
            <div class="flex gap-6 items-center">
                <label for="image">Ajouter une image</label>
                <input type="file" id="image" name="image" class="w-48" accept="image/*" @change="imagePreview = URL.createObjectURL($event.target.files[0])">
                <div class="flex flex-col gap-4">
                    {{-- image preview --}}
                    <img x-show="imagePreview" :src="imagePreview" alt="Image Preview" class="w-28">
                    <button x-show="imagePreview" type="submit" class="bg-blue-200 hover:bg-blue-300 border flex gap-2 items-center border-gray-400 text-gray-700 text-sm font-semibold rounded px-4 py-2"><span>ENVOYER</span><svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.3009 13.6949L20.102 3.89742M10.5795 14.1355L12.8019 18.5804C13.339 19.6545 13.6075 20.1916 13.9458 20.3356C14.2394 20.4606 14.575 20.4379 14.8492 20.2747C15.1651 20.0866 15.3591 19.5183 15.7472 18.3818L19.9463 6.08434C20.2845 5.09409 20.4535 4.59896 20.3378 4.27142C20.2371 3.98648 20.013 3.76234 19.7281 3.66167C19.4005 3.54595 18.9054 3.71502 17.9151 4.05315L5.61763 8.2523C4.48114 8.64037 3.91289 8.83441 3.72478 9.15032C3.56153 9.42447 3.53891 9.76007 3.66389 10.0536C3.80791 10.3919 4.34498 10.6605 5.41912 11.1975L9.86397 13.42C10.041 13.5085 10.1295 13.5527 10.2061 13.6118C10.2742 13.6643 10.3352 13.7253 10.3876 13.7933C10.4468 13.87 10.491 13.9585 10.5795 14.1355Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>
        </form>

        {{-- Container --}}
        <div class="flex gap-12 items-center">

            {{-- Back --}}
            <a href="{{ route('creations.index') }}" class="underline underline-offset-4 decoration-slate-300 font-light text-gray-800 hover:text-gray-700">Retour à l'accueil</a>
            {{-- Delete creation --}}
            <div>
                <form action="{{ route('creations.destroy', $creation) }}" method="post" x-data="{ open: false }">
                    @method('DELETE')
                    @csrf
                    <button type="button" @click="open = true" class="rounded-md text-gray-200 py-1.5 bg-amber-700 hover:bg-amber-800 transition duration-200 ease-in-out px-3 text-sm">Supprimer la création</button>
                    {{-- Confirmation modal window --}}
                    <div x-show="open" x-cloak @click.outside="open = false" class="absolute bg-gray-50 flex flex-col pt-24 items-center gap-24 rounded border z-[1] left-1/4 top-20 w-8/12 h-4/6">
                        <p class="font-bold">Êtes-vous sûr de vouloir supprimer cette création ?</p>
                        <div class="flex gap-20">
                            <button type="submit"
                            class="rounded-md text-gray-200 py-1.5 bg-amber-700 px-8">Oui</button>
                            <button type="button" @click="open = false"
                            class="rounded-md text-gray-200 py-1.5 bg-gray-600 px-8">Non</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>


</x-app-layout>
