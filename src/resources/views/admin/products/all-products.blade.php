@component('admin.layouts.content')
<style>
  
  .note:hover {
    background-color: #919191;
    box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.3);

  }

  .note .note-body {
    outline: 0;
    font-family: 'Caveat', cursive;
    font-size: 24px;
    padding: 10px 16px 16px;
  }
  


</style>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">

    <div class="card-body">
        <div class="d-flex justify-content-between">
          <h4 class="card-title">Product List</h4>
            <div>
              @can('create-product')
              <a class="nav-link btn btn-sm btn-success  " href="{{ route('create-product') }}">+ Create  Product</a>
              @endcan
            </div>
        </div>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th> # </th>
              <th>Image </th>
              <th>Title </th>
              <th>description </th>
              <th>Price </th>
              <th>Discount Price </th>
              <th>Quantity </th>
              <th>category  </th>
              <th> Action </th>
            </tr>
          </thead>
          <tbody>
          @foreach ( $products as $product)
            <tr class="item_type product">
                <input type="hidden" class="delete_val_id" value="{{ $product->id }}">
                <td> {{  $product->id }} </td>              
                <td>  <img src="{{ asset('productImage/'. $product->image) }}" alt="{{ $product->title }}"> </td>
                <td> {{ $product->title }}</td>
                <td> {{ $product->description }}</td>
                <td> {{ $product->price }}</td>
                <td> {{ $product->discount_price  }}</td>
                <td> {{ $product->quantity }}</td> 
                <td> {{ $product->category->name  }}</td>
                
                <td>
                  @can('edit-product')
                  <a href="{{ route('edit-product',$product->id ) }}" class="btn btn-sm btn-info">Edit</a>
                  @endcan
                  @can('delete-product')
                  <button type="submit" class="btn btn-sm btn-danger deletebtn" ">Delete</button>
                  @endcan
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
     
    
    </div>
    <div class="note">
    <div class="note-body">
      {{ $products->links() }}
    </div>
  </div>
</div>
  </div>
  
@endcomponent
