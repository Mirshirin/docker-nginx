@extends('home.master')

@section('content')
<section class="product_section layout_padding">
    <div class="container">
       <div class="heading_container heading_center">
          <h2>
             Our <span>products</span>
          </h2>
       </div>
       <div class="row">          
        @foreach ($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-4">
         <div class="box">
            <div class="option_container">
               <div class="options">
                  <a href="{{ route("product-detail",$product->id) }}" class="option1">
                     More Detail
                  </a>                 
                  <form action="{{ route('add-cart',$product->id) }}" method="POST">
                     @csrf
                    
                     <div class="row">
                        <div class="col-md-4">
                           <input type="number" min="1" name="quantity" value="1" id="" class="option1">
                        </div >
                        <div class="col-md-4">
                           <input type="submit" value="Add to Cart" name="" id="" class="option1">
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <div class="img-box">
               <img src="/productImage/{{ $product->image }}" alt="{{ $product->title }}">
            </div>
            <div class="detail-box">
               <h5>
                  {{ $product->title }}
               </h5>
               @if ( $product->discount_price !=null)
               <h6 style="color: red ">
                  ${{ $product->discount_price }}
               </h6>
               <h6 style="text-decoration-line: line-through">
                  ${{ $product->price }}
               </h6>
                @else
                <h6>
                  ${{ $product->price }}
               </h6>
               @endif
               
              
            </div>
         </div>
     </div>
        @endforeach
       </div>
       <div class="btn-box">
          <a href="">
          View All products
          </a>
       </div>
    </div>
 </section>
@endsection    
