<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderByDesc('id')->paginate(10);
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Name is required'
        ]);

        $input = [
            'name' => $request->input('name')
        ];

        Category::create($input);

        return redirect()->route('category')->with('msg', 'Category Create Successfully');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Name is required'
        ]);

        $input = [
            'name' => $request->input('name')
        ];

        $category = Category::find($id);
        $category->update($input);

        return redirect()->route('category')->with('msg', 'Category Update Successfully');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category')->with('msg', 'Category Delete Successfully');
    }
}