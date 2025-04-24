<x-app-layout>
    <div class="flex justify-center">
        <div class="flex flex-col max-w-7xl rounded mt-12 border">
            <h2 class="bg-gray-300 font-semibold p-2">Catégories</h2>
            @foreach ($categories as $category)
                <p class="border-b p-2">{{ $category->name }}</p>
            @endforeach
        </div>
    </div>
</x-app-layout>