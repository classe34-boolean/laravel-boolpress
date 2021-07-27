<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Category;

class CategoryController extends Controller
{
    public function show(Category $category) {
        // 1. recuperare la Categoria con quell'id
        // $category = Category::findOrFail($id);
        
        // 2 passarla alla vista di Categoria
        return view('admin.categories.show', compact('category'));
    }
}
