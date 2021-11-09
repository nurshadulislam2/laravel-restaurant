<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::orderByDesc('id')->paginate(10);
        return view('food.index', compact('foods'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('food.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'image' => 'required | image',
            'price' => 'required | numeric',
            'description' => 'required'
        ]);

        $image = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move('uploads/foods/', $image);

        $inputs = [
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'image' => $image,
            'price' => $request->input('price'),
            'description' => $request->input('description')
        ];

        Food::create($inputs);

        return redirect()->route('food')->with('msg', 'Food Created');
    }

    public function edit($id)
    {
        $food = Food::find($id);
        $categories = Category::all();
        return view('food.edit', compact('food', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required | numeric',
            'description' => 'required'
        ]);

        $food = Food::find($id);
        $inputs = [
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'price' => $request->input('price'),
            'description' => $request->input('description')
        ];
        $food->update($inputs);

        if ($request->file('image')) {
            unlink('uploads/foods/' . $food->image);
            $image = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move('uploads/foods/', $image);
            $food->update(['image' => $image]);
        }

        return redirect()->route('food')->with('msg', 'Food updated');
    }

    public function delete($id)
    {
        $food = Food::find($id);
        unlink('uploads/foods/' . $food->image);
        $food->delete();
        return redirect()->route('food')->with('msg', 'Food deleted');
    }
}