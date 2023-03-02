<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;



class CategoriesController extends Controller
{
    public function index(): View
    {
        // select * from categories
        $categories = Category::all();

        //jei noriu atfiltruoti, pvz, tik ištrinta ssu softDelete:
        //$categories = Category::onlyTrashed()->get();

        return view('admin/category/index', [
            'categories' => $categories
        ]);
    }

    public function create(): View
    {

        // SELECT * FROM categories WHERE category_id IS NULL
        $categories = Category::where('id', null)->get();
        //get'as naudojamas kuriant querius su where, join ir pan.
        //get'as nereikalingas ant all, find

        return view('admin/category/create', [
            'categories' => $categories
        ]);
    }

    public function edit(int $id, Request $request)
    {
        $category = Category::find($id); //=select * from categories where id = {$id} = new Category()
        if ($category === null) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $request->validate(
                ['name' => 'required|min:3|max:20']
            );


            // $request->validated();


            // $category->name = $request->post('name');
            $category->fill($request->all());
            $category->is_active = $request->post('is_active', false);
            $category->save();

            $categories = Category::where('id', null)->get();


            // arba kitas metodas, vietoj 3 eiluciu tik viena:
            // $category->update($request->all());
            return redirect('admin/categories')->with('success', 'Category updated successfully!');
        }

        $categories = Category::where('id', null)->get();
        
        return view('admin/category/edit', [
            'category' => $category,
            'categories' => $categories,
        ]);
    }
    public function show(int $id): View
    {
        // dd($id);
        $category = Category::find($id);
        // dd($category->books);
        // $category->books;

        if ($category === null) {
            abort(404);
        }
        // $category->books;
        // $book->category;

        return view('categories/show', [
            'category' => $category
        ]);
    }
    public function store(StoreCategoryRequest $request): RedirectResponse
    {

        $request->validated();
        $category=new Category();
        $category->fill($request->all());
        $category->is_active = $request->post('is_active', false);
        $category->save();
        return redirect('admin/categories')
            ->with('success', 'Category created successfully!');
    }
    public function delete(int $id)
    {
        //1. Gaunam pagal id kokia kategorija isvalyt
        $category = Category::find($id);
        //2. Patikrinam ar tokia egzistuoja
        if ($category === null) {
            //3. jeigu neegzistuoja metam 404
            abort(404);
        }
        //4. jeigu egzistuoja isvalom
        $category->delete();
        //5. Po sėkmingo išvalymo redirectinam su sėkmės pranešimu.
        return redirect('admin/categories')->with('success', 'Category removed successfully!');
    }
}
