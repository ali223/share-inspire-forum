<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    
    public function index()
    {
        $categories = Category::getCategoriesWithTopicsCount();
        
        return view('categories.index', compact('categories'));
    }
}
