<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
 
class FrontController extends Controller
{
    public function home(): View
    {
        $recipes = Recipe::query()
            ->latest()
            ->limit(10)
            ->get();
           
        return view('front/home', [
            'recipes' => $recipes,
        ]);
    }
    public function index(Request $request): View
    {
        $recipes = Recipe::where('is_active', '=', 1);

        if ($request->query('category_id')) {
            $recipes->where('category_id', '=', $request->query('category_id'));
        }
 
        if ($request->query('name')) {
            $recipes->where('name', 'like', '%' . $request->query('name') . '%');
        }
       
        $categories = Category::where('is_active', '=', 1)->get();
 
        return view('front/index', [
            'recipes' => $recipes->paginate(5),
            'categories' => $categories,
            'category_id' => $request->query('category_id'),
            'name' => $request->query('name'),
        ]);
    }
 
    public function show(int $id): View
    {
        $recipe = Recipe::find($id);
        if ($recipe === null) {
            abort(404);
        }
 
        return view('front/show', [
            'recipe'=> $recipe,
        ]);
    }
}
