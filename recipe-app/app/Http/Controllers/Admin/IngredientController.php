<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
// use App\Models\Category;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class IngredientController extends Controller
{
    public function index(): View
    {
        // select * from categories
        $ingredients = Ingredient::all();

        //jei noriu atfiltruoti, pvz, tik ištrinta ssu softDelete:
        //$categories = Category::onlyTrashed()->get();

        return view('admin/ingredient/index', [
            'ingredients' => $ingredients
        ]);
    }


public function create(): View
{

    // SELECT * FROM categories WHERE category_id IS NULL
    $ingredients = Ingredient::where('id', null)->get();
    //get'as naudojamas kuriant querius su where, join ir pan.
    //get'as nereikalingas ant all, find

    return view('admin/ingredient/create', [
        'ingredients' => $ingredients
    ]);
}

public function edit(int $id, Request $request)
{
    $ingredient = Ingredient::find($id); //=select * from categories where id = {$id} = new Category()
    if ($ingredient === null) {
        abort(404);
    }

    if ($request->isMethod('post')) {

        $request->validate(
            ['name' => 'required|min:3|max:20']
        );


        // $request->validated();


        // $category->name = $request->post('name');
        $ingredient->update($request->all());
        $ingredient->is_active = $request->post('is_active', false);
        $ingredient->save();

        // $ingredients = Ingredient::where('id', null)->get();


        // arba kitas metodas, vietoj 3 eiluciu tik viena:
        // $category->update($request->all());
        return redirect('admin/ingredient')->with('success', 'Ingredient updated successfully!');
    }

    // $ingredients = Ingredient::where('id', null)->get();
    
    return view('admin/ingredient/edit', [
        'ingredient' => $ingredient,
        // 'ingredients' => $ingredients,
    ]);
}
public function show(int $id): View
{
    // dd($id);
    $ingredient = Ingredient::find($id);
    // dd($category->books);
    // $category->books;

    if ($ingredient === null) {
        abort(404);
    }
    // $category->books;
    // $book->category;

    return view('admin/ingredient/show', [
        'ingredient' => $ingredient
    ]);
}
public function store(StoreCategoryRequest $request): RedirectResponse
{

    $request->validated();
    $ingredient=new Ingredient();
    $ingredient->fill($request->all());
    $ingredient->is_active = $request->post('is_active', false);
    $ingredient->save();
    return redirect('admin/ingredient')
        ->with('success', 'Ingredient created successfully!');
}
public function delete(int $id)
{
    //1. Gaunam pagal id kokia kategorija isvalyt
    $ingredient = Ingredient::find($id);
    //2. Patikrinam ar tokia egzistuoja
    if ($ingredient === null) {
        //3. jeigu neegzistuoja metam 404
        abort(404);
    }
    //4. jeigu egzistuoja isvalom
    $ingredient->delete();
    //5. Po sėkmingo išvalymo redirectinam su sėkmės pranešimu.
    return redirect('admin/ingredient')->with('success', 'Ingredient removed successfully!');
}

}