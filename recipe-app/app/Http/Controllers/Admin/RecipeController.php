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
        // select * from categories
        $recipes = Recipe::all();

        //jei noriu atfiltruoti, pvz, tik ištrinta ssu softDelete:
        //$categories = Category::onlyTrashed()->get();

        return view('admin/recipe/index', [
            'recipes' => $recipes
        ]);
    }

    public function create(): View
    {

        // SELECT * FROM categories WHERE category_id IS NULL
        $categories = Category::where('is_active', 1)->get();
        $ingredients = Ingredient::where('is_active', 1)->get();
        

        //get'as naudojamas kuriant querius su where, join ir pan.
        //get'as nereikalingas ant all, find

        return view('admin/recipe/create', [
            'categories' => $categories,
            'ingredients' => $ingredients
        ]);
    }

    public function edit(int $id, Request $request)
    {
        $recipe = Recipe::find($id); //=select * from categories where id = {$id} = new Category()
        if ($recipe === null) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $request->validate(
                ['name' => 'required|min:3|max:20']
            );


            // $request->validated();


            // $category->name = $request->post('name');
            $recipe->fill($request->all());
            $recipe->is_active = $request->post('is_active', false);
            $recipe->save();

            $recipes = Recipe::where('id', null)->get();


            // arba kitas metodas, vietoj 3 eiluciu tik viena:
            // $category->update($request->all());
            return redirect('admin/recipe')->with('success', 'Recipe updated successfully!');
        }

        $recipes = Recipe::where('id', null)->get();
        
        return view('admin/recipe/edit', [
            'recipe' => $recipe,
            // 'categories' => $categories,
        ]);
    }
    public function show(int $id): View
    {
        // dd($id);
        $recipe = Recipe::find($id);
        // dd($category->books);
        // $category->books;

        if ($recipe === null) {
            abort(404);
        }
        // $category->books;
        // $book->category;

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
        //1. Gaunam pagal id kokia kategorija isvalyt
        $recipe = Recipe::find($id);
        //2. Patikrinam ar tokia egzistuoja
        if ($recipe === null) {
            //3. jeigu neegzistuoja metam 404
            abort(404);
        }
        //4. jeigu egzistuoja isvalom
        $recipe->delete();
        //5. Po sėkmingo išvalymo redirectinam su sėkmės pranešimu.
        return redirect('admin/recipe')->with('success', 'Recipe removed successfully!');
    }
}
