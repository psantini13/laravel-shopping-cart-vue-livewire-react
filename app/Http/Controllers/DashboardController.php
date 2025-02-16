<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Services\PriceService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(Request $request, PriceService $priceService): Response
    {
        $selected = $request->input('selected', [
            'prices' => [],
            'categories' => [],
            'manufacturers' => []
        ]);

        $prices = $priceService->getPrices(
            [],
            $selected['categories'] ?? [],
            $selected['manufacturers'] ?? []
        );

        $categories = Category::withCount(['products' => function ($query) use ($selected) {
            $query->withFilters(
                $selected['prices'] ?? [],
                [],
                $selected['manufacturers'] ?? []
            );
        }])
            ->get();
        $manufacturers = Manufacturer::withCount(['products' => function ($query) use ($selected) {
            $query->withFilters(
                $selected['prices'] ?? [],
                $selected['categories'] ?? [],
                []
            );
        }])
            ->get();

        $products = Product::withFilters(
            $selected['prices'] ?? [],
            $selected['categories'] ?? [],
            $selected['manufacturers'] ?? []
        )->get();

        return Inertia::render('Dashboard', [
            'prices' => $prices,
            'categories' => $categories,
            'manufacturers' => $manufacturers,
            'selected' => $selected,
            'products' => $products,
            'cart' => Cart::count(),
            'cartProducts' => Cart::pluck('product_id')->unique()->toArray(),
        ]);
    }
}
