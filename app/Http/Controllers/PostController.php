<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        return Inertia::render('posts/Index');
    }

    public function create()
    {
        return Inertia::render('posts/Create');
    }
}
