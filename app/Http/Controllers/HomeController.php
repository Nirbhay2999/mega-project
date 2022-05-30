<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
         $categories =Category::all();
         $posts = Post::when(request('category_id'), function($q){
            $q->where('category_id',request('category_id'));
         })->latest()
          ->get();



         return view('welcome',compact('categories','posts'));

}

      public function show($id)
      {
          $post =Post::with('category')->find($id);
          return view ('show' , compact('post'));
      }
}
