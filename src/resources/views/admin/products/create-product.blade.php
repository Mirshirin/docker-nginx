@component('admin.layouts.content')

<div class="col-12 grid-margin stretch-card">
  <div class="card">
<div class="card-body">
    <h4 class="card-title">Create Product</h4>
   
    <form id="frm" class="form-inline" method="POST" action="{{ route('store-product') }} " enctype="multipart/form-data">
        @csrf
      <label class="sr-only-visible" for="inlineFormInputName2">Title</label>
      <input type="text" class="form-control mb-2 mr-sm-2" name="title"  placeholder="Enter product name" style= "background-color:white !important; color: black;" >
      <label class="sr-only-visible" for="inlineFormInputName2">Description</label>
      <textarea  class="form-control" cols="30" rows="5" name="description" placeholder="Enter description " style= "background-color:white !important; color: black;"></textarea>
      <label class="sr-only-visible" for="inlineFormInputName2">Product Price</label>
      <input type="number" class="form-control mb-2 mr-sm-2" name="price"  placeholder="Enter price " style= "background-color:white !important; color: black;" >
      <label class="sr-only-visible" for="inlineFormInputName2">Product Discount</label>
      <input type="number" class="form-control mb-2 mr-sm-2" name="discount_price"  placeholder="Enter product discount " style= "background-color:white !important; color: black;" >
      <label class="sr-only-visible" for="nlineFormInputName2"> Product Quantity</label>
      <input type="number" class="form-control mb-2 mr-sm-2" name="quantity"  placeholder="Enter quantity name" style= "background-color:white !important; color: black;" >
      <label class="sr-only-visible" for="nlineFormInputName2">Product Categories</label>
            <select  class="form-control" name="category_id"  style= "background-color:white !important; color: black !important;">
              <option value="" selected="">Add a category</option>
              @foreach ($categories as  $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
      <label class="sr-only-visible" for="inlineFormInputName2">Image</label>
      <input type="file" class="form-control"   name="image"  placeholder="Enter product discount " style= "background-color:white !important; color: black;" >

      <br>
      <button type="submit" class="btn btn-primary mb-2">Submit</button>
    </form>
  </div>
</div>
</div>
@endcomponent
