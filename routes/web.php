<?php

use Illuminate\Support\Facades\Route;
use Ogilo\AdminMd\Models\Page;
use Ogilo\Partners\Models\Partner;

Route::get('partners/list', function () {
    $page = new Page();
    $page->title = "Partners";
    $page->name = "partners";

    $partners = Partner::where('published', 1)->get();
    return view('partners::partners', compact('page', 'partners'));
})->middleware('guest');
