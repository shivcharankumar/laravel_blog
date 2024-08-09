<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function categorypage (Request $request){
        $categories = Category::all();
        return view('auth.categories.index',compact('categories'));
    }
}
