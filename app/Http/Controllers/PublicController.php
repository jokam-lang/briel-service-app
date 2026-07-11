<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;
use App\Models\Portfolio;

class PublicController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $portfolios = Portfolio::latest()->take(6)->get();
        return view('public.home', compact('categories', 'portfolios'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $services = Service::where('category_id', $category->id)->latest()->get();
        return view('public.category', compact('category', 'services'));
    }

    public function portfolio()
    {
        $portfolios = Portfolio::latest()->get();
        return view('public.portfolio', compact('portfolios'));
    }
}
