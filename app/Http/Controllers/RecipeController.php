<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function search(Request $request)
{
    $query = $request->input('query');

    // Fetch recipes from the database using a search query
    $recipes = Recipe::where('title', 'like', '%' . $query . '%')->get();

    // Check if no recipes are found
    if ($recipes->isEmpty()) {
        // Redirect back to dashboard with error message
        return redirect()->route('dashboard')->with('error', 'Sorry, no recipes found for your search.');
    }

    return view('recipes.search', compact('query', 'recipes'));
}


public function save(Request $request)
{
    // Validate the request data
    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'required|string|max:255',  // Changed 'url' to 'string'
    ]);

    $user = auth()->user();

    // Check if the recipe already exists in the saved recipes for the authenticated user
    $existingRecipe = $user->savedRecipes()->where('title', $request->title)->first();

    if ($existingRecipe) {
        // If the recipe already exists, return with an error message
        return redirect()->back()->with('error', 'This recipe has already been saved.');
    }

    // Create or find the recipe in the Recipe table
    $recipe = Recipe::firstOrCreate(
        ['title' => $request->title],
        [
            'image' => $request->image,  // Save image path
            'description' => $request->description ?? null,  // Optional, only if provided
            'ingredients' => $request->ingredients ?? null,  // Optional
            'instructions' => $request->instructions ?? null,  // Optional
        ]
    );

    // Attach the recipe to the authenticated user
    $user->savedRecipes()->attach($recipe->id);

    // Redirect back to the previous page with a success message
    return redirect()->back()->with('success', 'Recipe saved successfully!');
}


    
public function remove($id)
{
    $recipe = Recipe::findOrFail($id); // Find the recipe by its ID
    $user = auth()->user(); // Get the currently authenticated user

    // Check if the user is trying to remove it from their saved recipes
    // if ($user->savedRecipes()->where('recipe_id', $id)->exists()) {
    //     $user->savedRecipes()->detach($id); // Detach it from the user's saved recipes
    //     return redirect()->route('dashboard')->with('success', 'Recipe removed from your saved recipes.');
    // }

    // Check if the user is an admin or the owner of the recipe
    if ($user->email === 'admin@gmail.com' || $user->id === $recipe->user_id) {
        $recipe->delete(); // Permanently delete the recipe from the database
        return redirect()->route('dashboard')->with('success', 'Recipe deleted successfully.');
    }

    // If the user is neither an admin nor the owner
    return redirect()->back()->with('error', 'You are not authorized to delete this recipe.');
}

public function removeSavedRecipe($id)
{
    $recipe = Recipe::findOrFail($id); // Find the recipe by its ID
    $user = auth()->user(); // Get the currently authenticated user

    // Check if the user is trying to remove it from their saved recipes
    if ($user->savedRecipes()->where('recipe_id', $id)->exists()) {
        $user->savedRecipes()->detach($id); // Detach it from the user's saved recipes
        return redirect()->route('dashboard')->with('success', 'Recipe removed from your saved recipes.');
    }

    // If the user is neither an admin nor the owner
    return redirect()->back()->with('error', 'You are not authorized to delete this recipe.');
}




// In RecipeController.php

// public function index()
// {
//     // Logic to fetch recipes, etc.
//     return view('recipes.index');
// }




public function show($id)
{
    $recipe = Recipe::findOrFail($id);
    return view('recipes.show', compact('recipe'));
}

public function create()
    {
        return view('recipes.create');
    }

    // Store a new recipe in the database
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
        ]);
    
        // Handle the image upload if a file is provided
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Store the image in the 'recipes' folder under the 'public' disk
            $imagePath = $request->file('image')->store('recipes', 'public'); // This stores the image and returns the relative path
        }
    
        // Create and save the recipe in the database
        $recipe = new Recipe();
        $recipe->title = $request->title;
        $recipe->image = $imagePath;  // Save the image path (relative) in the database
        $recipe->description = $request->description;
        $recipe->ingredients = $request->ingredients;
        $recipe->instructions = $request->instructions;
        $recipe->user_id = auth()->id();  // Associate recipe with the authenticated user
        $recipe->save();  // Save the recipe in the database
    
        // Redirect back to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Recipe added successfully!');
    }
    
    
    
    // Show the form for editing an existing recipe
    public function edit(Recipe $recipe)
    {
        // Check if the authenticated user is the owner of the recipe
        if ($recipe->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'You can only edit your own recipes.');
        }

        return view('recipes.edit', compact('recipe'));
    }

    // Update the specified recipe in the database
    public function update(Request $request, $id)
{
    $recipe = Recipe::findOrFail($id);

    // Validate inputs
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'ingredients' => 'required|string',
        'instructions' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Check if the user uploaded a new image
    if ($request->hasFile('image')) {
        // Store the image and get the file path
        $imagePath = $request->file('image')->store('recipes', 'public');
        $recipe->image = $imagePath; // Update image path
    }

    // Update other fields
    $recipe->title = $request->title;
    $recipe->description = $request->description;
    $recipe->ingredients = $request->ingredients;
    $recipe->instructions = $request->instructions;

    // Save the updated recipe
    $recipe->save();

    return redirect()->route('recipes.show', $recipe->id)->with('success', 'Recipe updated successfully!');
}

// app/Http/Controllers/RecipeController.php

public function destroy($id)
{
    $recipe = Recipe::findOrFail($id);  // Find the recipe by ID

    // Delete the recipe
    $recipe->delete();

    // Redirect back to the dashboard with a success message
    return redirect()->route('dashboard')->with('success', 'Recipe deleted successfully!');
}

    
}
