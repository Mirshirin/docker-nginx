@component('admin.layouts.content')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">

    <div class="card-body">
        <div class="d-flex justify-content-between">
          <h4 class="card-title">Order List</h4>           
        </div>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th> # </th>
              <th>Image </th>              
              <th>Name </th>
              <th>Email </th>              
              <th>Phone </th>
              <th>Product |Title </th>              
              <th>Quantity </th>                          
              <th>Payment status </th>
              <th>Delivery status </th>  
              <th>Delivered</th>  
              <th>print pdf</th>  
            </tr>
          </thead>
          <tbody>
           <?php
             $id=auth()->user()->id;
           ?>
            @foreach ($orders as $order)
          
            @if ($order->user_id == $id)
                <tr>
                    <td> {{  $order->id }} </td>   
                    <td>  <img src="/productImage/{{ $order->image }}" alt="{{ $order->title }}"> </td>
                    <td> {{  $order->name }} </td> 
                    <td> {{  $order->email }} </td> 
                    <td> {{  $order->phone_number }} </td> 
                    <td> {{  $order->product_title }} </td> 
                    <td> {{  $order->quantity }} </td> 
                    <td> {{  $order->payment_status }} </td> 
                    <td> {{  $order->delivery_status }} </td> 
                    @if ($order->delivery_status == 'processing')
                        <td> 
                            <a href=" {{  route('delivered',$order->id) }}" class="btn btn-sm btn-info">Delivered</a>
                        </td> 
                    @else
                     <td style="color: green ;"> Delivered </td>   
                      
                    @endif
                    <td> 
                        <a href=" {{  route('print-pdf',$order->id) }}" class="btn btn-sm btn-success">Print pdf</a>
                    </td> 
                </tr>
            @endif
        @endforeach
        
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endcomponent
