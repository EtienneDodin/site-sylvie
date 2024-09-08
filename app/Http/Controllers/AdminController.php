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
            'name' => 'required|max:255',
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('creations.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate($this->rules());

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
        };

        return redirect()->route('creations.index');

    }

    // Store a new image for a given creation

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
        };

        return redirect()->route('creations.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Creation $creation)
    {
        return view('creations.show', compact('creation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Creation $creation)
    {
        $categories = Category::all();
        // $images = Image::where('creations_id', $creation->id)->get();
        
        return view('creations.edit', compact('categories', 'creation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Creation $creation, Image $image)
    {
        // $creation->update($request->all());
        
        $validatedData = $request->validate($this->rules());

        // dd($validatedData);

        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('image', $request->file('image'));
            $validatedData['image'] = '/storage/' . $path;

            $image->path->update($validatedData['image']);            
        };
        
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
            $image->delete();
        };
        
        $creation->delete();
        
        return redirect()->route('creations.index');
    }
}
