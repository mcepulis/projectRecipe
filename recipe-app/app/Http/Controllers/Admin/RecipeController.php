<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Ingredient;
use Illuminate\Http\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function index(): View
    {
        $recipes = Recipe::all();

        return view('admin/recipe/index', [
            'recipes' => $recipes
        ]);
    }

    public function create(): View
    {

        $categories = Category::where('is_active', 1)->get();
        $ingredients = Ingredient::where('is_active', 1)->get();

        return view('admin/recipe/create', [
            'categories' => $categories,
            'ingredients' => $ingredients
        ]);
    }

    public function edit(int $id, Request $request)
    {
        $categories = Category::all();
        $ingredients = Ingredient::all();
        $recipe = Recipe::find($id); 
        if ($recipe === null) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $request->validate(
                [
                    'name' => 'required|min:3|max:50',
                    'ingredient_id' => 'required',
                    'category_id' => 'required'
                ]
            );

            $recipe->fill($request->all());
            $recipe->ingredients()->detach();
            $recipe->ingredients()->attach($request->post('ingredient_id'));
            $recipe->is_active = $request->post('is_active', false);
            $file = $request->file('image');
            if ($file) {
            $path = Storage::disk('public')->putFile('recipe_image', new File($file));
            $recipe->image = $path;
            }
            $recipe->save();

            $recipes = Recipe::where('id', null)->get();

            return redirect('admin/recipe')->with('success', 'Recipe updated successfully!');
        }

        $recipes = Recipe::where('id', null)->get();
        
        return view('admin/recipe/edit', compact('categories','ingredients','recipe'));
    }
    public function show(int $id): View
    {
        $recipe = Recipe::find($id);

        if ($recipe === null) {
            abort(404);
        }

        return view('admin/recipe/show', [
            'recipe' => $recipe
        ]);
    }
    public function store(Request $request): RedirectResponse
    {

        $request->validate(
            [
                'name' => 'required|min:3|max:50',
                'ingredient_id' => 'required',
                'category_id' => 'required'
            ]
        );
        $recipe=Recipe::create($request->all());
        $recipe->is_active = $request->post('is_active', false);
        $ingredients = Ingredient::find($request->post('ingredient_id'));
        $recipe->ingredients()->attach($ingredients);
        $file = $request->file('image');
        if ($file) {
        $path = Storage::disk('public')->putFile('recipe_image', new File($file));
        $recipe->image = $path;
        }
        $recipe->save();
        
        return redirect('admin/recipe')
            ->with('success', 'Recipe created successfully!');
    }
    public function delete(int $id)
    {
        $recipe = Recipe::find($id);
        if ($recipe === null) {
            abort(404);
        }
        $recipe->delete();
        return redirect('admin/recipe')->with('success', 'Recipe removed successfully!');
    }
}
