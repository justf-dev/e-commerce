<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)
        ->where('status', 'active')
        ->with('category')
        ->latest()
        ->take(8)
        ->get();

        $categories = Category::where('is_active', true)
        ->withCount('products')
        ->get();

        return view('home', compact('featuredProducts', 'categories'));
    }
}
