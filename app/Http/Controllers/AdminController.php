<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use App\Models\Category;
use App\Models\Creation;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $creations = Creation::all();

        return view('creations.index', compact('categories', 'creations'));
    }

    /**
     * Rules to validate.
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'sold' => 'boolean',
            'description' => 'required|max:255',
            'dimensions' => 'nullable|max:255',
            'gallerymsg' => 'boolean',
            'price' => 'numeric|nullable',
            'category_id' => 'required|integer',
            'image' => 'image|mimes:jpeg,jpg,png,gif,svg,webp|max:2048',
        ];
    }

    /**
     * Custom validation messages.
     */

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom de la création est requis.',
            'description.required' => 'La description de la création est requise.',
            'description.max' => 'La description de la création ne doit pas dépasser 255 caractères.',
            'price.numeric' => 'Le prix de la création doit être un nombre sans le symbole €.',
            'category_id.required' => 'La catégorie de la création est requise.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'Le fichier doit être une image de type jpeg, jpg, png, gif, svg ou webp.',
            'image.max' => 'Le fichier ne doit pas dépasser 2 Mo.',
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('creations.create', compact('categories'));
    }

    /**
     * Global store of a new resource, creation and related images.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate($this->rules(), $this->messages());

        $creation = new Creation();
        $creation->name = $validatedData['name'];
        $creation->sold = $validatedData['sold'];
        $creation->description = $validatedData['description'];
        $creation->dimensions = $validatedData['dimensions'];
        $creation->gallerymsg = $validatedData['gallerymsg'];
        $creation->price = $validatedData['price'];
        $creation->category_id = $validatedData['category_id'];
        $creation->save();

        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('image', $request->file('image'));
            $validatedData['image'] = '/storage/' . $path;

            $image = new Image();
            $image->path = $validatedData['image'];
            $image->creation_id = $creation->id;
            $image->save();
        }

        return redirect()->route('creations.index')->with('status', 'Création ajoutée avec succès.');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Creation $creation)
    {
        $categories = Category::all();
        
        return view('creations.edit', compact('categories', 'creation'));
    }

    /**
     * Store a new image for a given creation.
     */

    public function storeImage(Request $request, Creation $creation)
    {
        $validatedData = $request->validate([
            'image' => 'image|mimes:jpeg,jpg,png,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('image', $request->file('image'));
            $validatedData['image'] = '/storage/' . $path;

            $image = new Image();
            $image->path = $validatedData['image'];
            $image->creation_id = $creation->id;
            $image->save();
        }

        return redirect()->route('creations.edit', $creation->id)->with('status', 'Image ajoutée avec succès.');
    }

    /**
     * Delete an image.
     */

    public function destroyImage(Image $image)
    {
        // Store creation id before deleting image
        $creationId = $image->creation_id;

        // Remove '/storage/' from file path
        $filePath = str_replace('/storage/', '', $image->path);

        // Delete image file
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        // Delete image
        $image->delete();

        return redirect()->route('creations.edit', $creationId)->with('status', 'Image supprimée avec succès.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Creation $creation)
    {        
        $validatedData = $request->validate($this->rules());
        
        $creation->name->update($validatedData['name']);
        $creation->sold->update($validatedData['sold']);
        $creation->description->update($validatedData['description']);
        $creation->dimensions->update($validatedData['dimensions']);
        $creation->gallerymsg->update($validatedData['gallerymsg']);
        $creation->price->update($validatedData['price']);
        $creation->category_id->update($validatedData['category_id']);

        return redirect()->route('creations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyCreation(Creation $creation)
    {
        foreach ($creation->images as $image) {
            // Remove '/storage/' from file path
            $filePath = str_replace('/storage/', '', $image->path);

            // Delete image file
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            // Delete image
            $image->delete();
        }
        
        $creation->delete();
        
        return redirect()->route('creations.index')->with('status', 'Création supprimée avec succès.');
    }
}
