<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class SearchController extends Controller
{
    
public function search(Request $request)
{
    $query = $request->input('query');
    $results = Product::where(function($queryBuilder) use ($query) {
        $queryBuilder->where('title', 'like', '%' . $query . '%')
                     ->orWhere('description', 'like', '%' . $query . '%');
    })->get();
    
    $products=Product::all();
    return view('admin.products.search-results', ['results' => $results , 'products' => $products]);
}

}
