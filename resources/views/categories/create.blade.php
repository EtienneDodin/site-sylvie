<x-app-layout>
    <form action="{{ route('categories.store') }}" method="POST" class="flex justify-center">
        @csrf
        <div>
            <div class="flex flex-col gap-3 items-center">
                <label for="name">Nom de la catégorie</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="rounded-md border-gray-300 w-72">
            </div>

            <button type="submit" class="bg-gray-800 hover:bg-gray-600 transition duration-200 ease-in-out rounded-xl mt-6 py-2 px-4 text-white">Insérer catégorie</button>
        </div>
    </form>
</x-app-layout>