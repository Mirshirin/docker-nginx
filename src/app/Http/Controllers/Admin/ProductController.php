<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\SharedFunctionalityTrait;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use SharedFunctionalityTrait;
    public function allProduct(){
        $products=Product::paginate(7);
        return view('admin.products.all-products')->with('products',$products);
    }
    public function createProduct(){
        $categories =Category::all();
        return view('admin.products.create-product')->with('categories',$categories);
    }
    public function storeProduct(Request $request){
      $request->validate([
            'title' => ['required','string','max:255'],
            'description' => ['required','string','max:255'],
            // 'image' =>'required|image|mimes:png,jpg,jpeg|max:2048',
            'discount_price'=>  ['nullable'],
            'quantity'=> ['required'],
            'price'=> ['required'],
            'category_id'=> ['required'],

        ]);
    
        $products=new Product();
        $products->title = $request->title;
        $products->description = $request->description;
        $products->discount_price = $request->discount_price;
        $products->quantity = $request->quantity;
        $products->price = $request->price;
        $products->category_id = $request->category_id;
        $image = $request->image;
        $imagename= time().'.'.$image->getClientOriginalExtension();
        $request->image->move('productImage', $imagename);
        $products->image = $imagename;
        $products->save();
        return redirect()->route('all-products')->with('message','Data saved.');
    }

    public function editProduct($id){
        $product=Product::find($id);      
        $categories=Category::all();
        return view('admin.products.edit-product')
        ->with('product',$product)
        ->with('categories',$categories);
    }
    public function updateProduct(Request $request, $id){
        $categories = Category::all();
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'discount_price' => ['nullable'],
            'quantity' => ['required'],
            'price' => ['required', 'max:999999999'],
            'category_id' => ['required'],
        ]);
    
        if (!is_null($request->image)) {
            $request->validate([
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            ]);
    
            // Find the product to update
            $product = Product::find($id);
            // Check if the product has an existing image

            $oldImage = $product->image;
         
            if ($oldImage) {
                // Delete the old image
                if (File::exists(public_path('productImage/'. $oldImage))) {
                    File::delete(public_path('productImage/'. $oldImage));
                }
            }
    
            // Process the new image upload
            $newImageName = time(). '.'. $request->image->getClientOriginalExtension();
            $request->image->move('productImage', $newImageName);
            $product->image = $newImageName;
            
        // Log the new image name for debugging
        Log::info('New image name: '.$newImageName);

        $product->save();
        }
          
        // Update the product details
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->discount_price = $request->discount_price;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
    
        $product->save();
    
        return redirect(route('all-products'))
            ->with('categories', $categories)
            ->with('message', 'Data updated.');
    }
    
    
    
    public function deleteProduct($id){
        $product=Product::find($id);
        $file_path= public_path('productImage').'/'.$product->image;
        if(File::exists($file_path)){
            File::delete($file_path);
            $product->delete();
        }
       
        return response()->json(['status'=> 'Data deleted successfully.']);
    }
    public function homeProducts(Request $request){
      // Fetch all products
    $products = Product::all();
 
    // Assuming you want to paginate 10 products per page
    $perPage = 6;
    $currentPage = LengthAwarePaginator::resolveCurrentPage()?: 1;
    $items = $products->slice(($currentPage - 1) * $perPage, $perPage)->all();

    $products = new LengthAwarePaginator($items, count($products), $perPage);

    // Set URL path for generated links
    $products->setPath(url('/'));
       
        return view('home.index',compact('products'));
}

}
