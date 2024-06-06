@extends('home.master')
@section('content')
    <section style="height: 100vh; margin-top:70px">
        <div class="container">
            <div class="container">
                <h1>Product List</h1>
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Product Title</th>
                        <th>Product Quantity</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody> 
                        @php
                        $totalPrice =0;
                        $totalProduct =0;
                        @endphp                 
                        @foreach ( $cartProducts as  $cartProduct )
                       
                        <tr>
                            <td>{{ $cartProduct->product_title }}</td>   
                            <td>{{ $cartProduct->quantity }}</td>   
                            <td>{{ $cartProduct->price }}</td>   
                            <td>
                                <img  src="/productImage/{{ $cartProduct->image }}" alt="{{ $cartProduct->product_title }}" style="width:30px ">  
                            </td>
                            <form action="{{ route('delete-carts', $cartProduct->id) }}" method="post">
                                @csrf                                
                                @method('DELETE')
                            <td><button type="submit" class="btn btn-danger btn-sm">Remove</button></td> 
                            </form>
                        </tr>  
                        @php
                        $totalPrice += $cartProduct->price;
                        $totalProduct +=$cartProduct->quantity;
                        @endphp 
                        @endforeach 
                        <tr>
                            <td>Products</td>
                            <td>{{ $totalProduct }}</td>
                            <td>${{ $totalPrice }}</td>
                            <td></td>
                            <td><big>total</td>
                            
                        </tr> 
                        
                    </tbody>
                    
                  </table>
                  <h1 style="font-size: 20px; font-weight:700;">Proceed to order</h1>
                  <a href="{{ route('cash-order') }}" class="btn btn-danger">Cash on Delivery</a>
                  <a href="{{ route('stripe',$totalPrice) }}" class="btn btn-danger">Pay Using Card</a>
                
                </div>
                
            </div>  
        </div>
    </section>
@endsection