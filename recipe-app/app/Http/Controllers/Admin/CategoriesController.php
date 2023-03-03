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
       
        $categories = Category::all();

        return view('admin/category/index', [
            'categories' => $categories
        ]);
    }

    public function create(): View
    {

        
        $categories = Category::where('id', null)->get();
        

        return view('admin/category/create', [
            'categories' => $categories
        ]);
    }

    public function edit(int $id, Request $request)
    {
        $category = Category::find($id); 
        if ($category === null) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $request->validate(
                ['name' => 'required|min:3|max:20']
            );


            
            $category->fill($request->all());
            $category->is_active = $request->post('is_active', false);
            $category->save();

            $categories = Category::where('id', null)->get();


            
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
        
        $category = Category::find($id);
        

        if ($category === null) {
            abort(404);
        }
        

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
        
        $category = Category::find($id);
        
        if ($category === null) {
            
            abort(404);
        }
       
        $category->delete();
        
        return redirect('admin/categories')->with('success', 'Category removed successfully!');
    }
}
