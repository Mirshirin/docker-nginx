<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\SharedFunctionalityTrait;
use Illuminate\Support\Facades\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;



class AdminController extends Controller
{
    use SharedFunctionalityTrait;

    public function dashboard() {
        $user = auth()->user(); 
        $metrics = $this->sharedFunction();
        $id = Auth::user()->id;
    
        $totalData = DB::table('orders')
            ->select(
                DB::raw('SUM(price) as total_price'),
                DB::raw('MAX(price) as highest_price'),
                DB::raw('SUM(CASE WHEN payment_status = "paid" THEN price ELSE 0 END) as revenue_Sales'),
                DB::raw('COUNT(DISTINCT CASE WHEN payment_status = "paid" THEN product_id END) as productSoldCount')
            )
            ->where('user_id', $user->id)
            ->first();
    
        $metrics['total_price'] = $totalData->total_price ?? null;
        $metrics['highest_price'] = $totalData->highest_price ?? null;
        $metrics['revenue_Sales'] = $totalData->revenue_Sales ?? null;
        $metrics['productSoldCount'] = $totalData->productSoldCount ?? null;
    
        return view('admin.index', compact('user', 'metrics')); 
    }
    
    
   
    public function  allOrders(){
        $orders=Order::all();
        return view('orders.all-orders', compact('orders'));
    }
    
    public function  delivered($id){
        $order=Order::find($id);
        $order->delivery_status = 'delivered';
        $order->payment_status = 'paid';
        $order->save();
        return redirect()->back();

    }
    
    public function printPdf($id){
      
        $order=Order::find($id);
        $pdf = Pdf::loadView('admin.report.pdf',compact('order'));
        return $pdf->download('order_details.pdf');
      
       
    }




}