<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function index($page_slug)
    {
        $page = Page::findBySlug($page_slug);
        return view('about-us', compact('page'));
    }
}
