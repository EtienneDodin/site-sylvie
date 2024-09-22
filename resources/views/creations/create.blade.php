<x-app-layout>
    <x-slot name="header">
        Nouvelle création
    </x-slot>

    <form action="{{ route('creations.store') }}" method="post" enctype="multipart/form-data"
        class="flex justify-center">
        @csrf
        <div class="py-8 flex flex-col gap-7 items-center">

            <div class="flex flex-col gap-3 items-center">
                <label for="name" class="font-semibold">Nom de la création</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="rounded-md border-gray-300 w-64">

                @error('name')
                    <p class="text-rose-700">{{ $message }}</p>
                @enderror
            </div>
    
            <div class="flex gap-4 items-center">
                <label for="sold">Création vendue ?</label>
                <input type="hidden" name="sold" value="0">
                <input type="checkbox" id="sold" name="sold" value="1">
            </div>
    
            <div class="flex flex-col gap-3 items-center">
                <label for="description" class="font-semibold">Description</label>
                <textarea id="description" name="description" value="{{ old('description') }}" class="rounded-md border-gray-300 w-64 h-28"></textarea>

                @error('description')
                    <p class="text-rose-700">{{ $message }}</p>
                @enderror
            </div>
    
            <div class="flex flex-col gap-3 items-center">
                <label for="dimensions" class="font-semibold">Dimensions</label>
                <input type="text" id="dimensions" name="dimensions" value="{{ old('dimensions') }}" class="rounded-md border-gray-300 w-64">
            </div>
    
            <div class="flex gap-4 items-center">
                <label for="gallerymsg">Est-elle en galerie ?</label>
                <input type="hidden" name="gallerymsg" value="0">
                <input type="checkbox" id="gallerymsg" name="gallerymsg" value="1">
            </div>
    
            <div class="flex flex-col gap-3 items-center">
                <label for="price" class="font-semibold">Prix</label>
                <input type="text" id="price" name="price" class="rounded-md border-gray-300 w-64">

                @error('price')
                    <p class="text-rose-700">{{ $message }}</p>
                @enderror
            </div>
    
            <div class="flex flex-col gap-3 items-center">
                <label for="category_id" class="font-semibold">Catégorie</label>

                <select name="category_id" id="category_id" class="w-64 border-gray-300 rounded-md">
    
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>
                            {{ $category->category }}
                        </option>
                    @endforeach
    
                </select>

                @error('category_id')
                    <p class="text-rose-700">{{ $message }}</p>
                @enderror
            </div>
    
            <div class="flex gap-6 items-center" x-data="{ imagePreview: '' }">
                <div class="flex flex-col gap-4 items-center">
                    <label for="image" class="font-semibold">Ajouter une image</label>
                    <input type="file" id="image" name="image" class="file:text-amber-800 file:bg-gray-200 hover:file:bg-gray-300 file:px-3 file:py-1.5 file:mr-2 file:border file:rounded text-gray-600 mt-2" accept="image/*" @change="imagePreview = URL.createObjectURL($event.target.files[0])">

                    @error('image')
                        <p class="text-rose-700">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- image preview --}}
                <img x-show="imagePreview" :src="imagePreview" alt="Image Preview" class="w-28">
            </div>

            <div class="flex gap-14 items-baseline">
                <a href="{{ route('creations.index') }}" class="underline underline-offset-2 hover:text-gray-800">Retour au menu</a>
                <button type="submit" class="bg-gray-800 hover:bg-gray-600 transition duration-200 ease-in-out rounded-xl mt-6 py-2 px-4 text-white">Insérer la création</button>
            </div>
        </div>
    </form>
</x-app-layout>
