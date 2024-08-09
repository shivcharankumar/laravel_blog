<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
class DasboardController extends Controller
{
    public function dasboard(){
        $postcount = Post::count();
        $tagcount = Tag::count();
        $categorycount = Category::count();
        $usercount = User::count();
        return view('auth.dasboard',compact('postcount','tagcount','categorycount','usercount'));
    }
}
