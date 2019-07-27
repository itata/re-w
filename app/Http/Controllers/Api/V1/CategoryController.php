<?php

namespace App\Http\Controllers\Api\V1;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }
    public function show($id)
    {
        return Category::findOrFail($id);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $category = Category::create($input);
        return $category;
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return '';
    }
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $input = $request->all();
        $category->update($input);
        return $category;
    }
}
