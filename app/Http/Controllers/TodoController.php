<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    //
    public function index()
    {
        //get posts
        $posts = Todo::latest();

        //return collection of posts as a resource
        return new TodoResource(true, 'List Data Todo', $posts);
    }
}
