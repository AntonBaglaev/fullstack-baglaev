<?php

namespace App\Http\Controllers;

use Domain\Catalog\Models\Brand;
use Domain\Catalog\ViewModels\CategoryViewModel;
use Domain\Product\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
    public function __invoke(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $categories =CategoryViewModel::make()
            ->homePage();

        $products = Product::query()
            ->homePage()
            ->get();

        $brands = Brand::query()
            ->homePage()
            ->get();

        return view('index', compact(
            'categories',
            'products',
            'brands'
        ));
    }
}
