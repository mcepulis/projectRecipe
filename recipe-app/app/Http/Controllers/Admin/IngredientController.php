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
        
        $ingredients = Ingredient::all();


        return view('admin/ingredient/index', [
            'ingredients' => $ingredients
        ]);
    }


public function create(): View
{

    
    $ingredients = Ingredient::where('id', null)->get();

    return view('admin/ingredient/create', [
        'ingredients' => $ingredients
    ]);
}

public function edit(int $id, Request $request)
{
    $ingredient = Ingredient::find($id); 
    if ($ingredient === null) {
        abort(404);
    }

    if ($request->isMethod('post')) {

        $request->validate(
            ['name' => 'required|min:3|max:20']
        );


        $ingredient->update($request->all());
        $ingredient->is_active = $request->post('is_active', false);
        $ingredient->save();


        return redirect('admin/ingredient')->with('success', 'Ingredient updated successfully!');
    }
    
    return view('admin/ingredient/edit', [
        'ingredient' => $ingredient,
    ]);
}
public function show(int $id): View
{
    $ingredient = Ingredient::find($id);

    if ($ingredient === null) {
        abort(404);
    }

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
    $ingredient = Ingredient::find($id);
    if ($ingredient === null) {
        abort(404);
    }
    $ingredient->delete();
    return redirect('admin/ingredient')->with('success', 'Ingredient removed successfully!');
}

}