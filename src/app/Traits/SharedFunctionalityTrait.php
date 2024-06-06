<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait SharedFunctionalityTrait
{
    public function sharedFunction()
    {
        // Function logic
        
        $id = Auth::user()->id;
        $totalPrice = DB::table('orders')
        ->where('user_id', $id)
        ->select(DB::raw('SUM(price) as total_price'))
        ->get();  
        $highestPrice = DB::table('orders')        
        ->select(DB::raw('MAX(price) as highest_price'))
        ->get(); 
        $revenueSales = DB::table('orders')   
        ->where('payment_status', 'paid')     
        ->select(DB::raw('SUM(price) as revenue_Sales'))
        ->get(); 
        $productSoldCount = DB::table('orders')
        ->where('payment_status', 'paid')
        ->distinct('product_id')
        ->count('product_id');
            return ['totalPrice' => $totalPrice,
            'highestPrice' => $highestPrice,
            'revenueSales'=> $revenueSales,
            'productSoldCount' => $productSoldCount,
        ];
    }
}