<?php


namespace App\Http\Controllers;

use App\Models\Recipe;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all recipes
        $recipes = Recipe::all();  // Or use pagination: Recipe::paginate(10);

        // Return the view with the recipes
        return view('admin.dashboard', compact('recipes'));
    }
// app/Http/Controllers/UserController.php

public function destroy($id)
{
    $recipe = Recipe::findOrFail($id);  // Find the recipe by ID

    // Delete the recipe
    $recipe->delete();

    // Redirect back to the dashboard with a success message
    return redirect()->route('admin.dashboard')->with('success', 'Recipe deleted successfully!');
}
   
}




