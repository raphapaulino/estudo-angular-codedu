<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('app.category.index', compact('categories'));
    }

    public function create()
    {
        $category = new Category;
        return view('app.category.create', compact('category'));
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->all());
        return redirect()->route('app.categories.index');
    }

    public function show(Category $category) //Category::where('company_id', 1)->findOrFail(51)
    {
        return view('app.category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('app.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->fill($request->all());
        $category->save();
        return redirect()->route('app.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('app.categories.index');
    }
}
