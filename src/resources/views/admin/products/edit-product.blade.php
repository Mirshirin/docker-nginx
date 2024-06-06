@component('admin.layouts.content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Product</h4>

        <form id="frm" class="form-inline" method="POST" action="{{ route('update-product',$product->id) }}"   enctype="multipart/form-data">
            @csrf
            @method('put')
            <label class="sr-only-visible" for="inlineFormInputName2">title</label>
            <input type="text" class="form-control mb-2 mr-sm-2" name="title"   value="{{ old('title', $product->title) }}" placeholder="Enter product name" style= "background-color:white !important; color: black;">
            <label class="sr-only-visible" for="inlineFormInputName2">Description</label>
            <input  class="form-control" cols="30" rows="5" name="description"  value="{{ old('description', $product->description) }}"  placeholder="Enter description" style= "background-color:white !important; color: black;"></input>
            <label class="sr-only-visible" for="inlineFormInputName2">Product Price</label>
            <input type="number" class="form-control mb-2 mr-sm-2" name="price" value="{{ old('price', $product->price) }}" placeholder="Enter price " style= "background-color:white !important; color: black;" >
            <label class="sr-only-visible" for="inlineFormInputName2">Product Discount</label>
            <input type="number" class="form-control mb-2 mr-sm-2" name="discount_price"  value="{{ old('discount_price', $product->discount_price) }}" placeholder="Enter product discount " style= "background-color:white !important; color: black;" >
            <label class="sr-only-visible" for="inlineFormInputName2"> Product Quantity</label>
            <input type="number" class="form-control mb-2 mr-sm-2" name="quantity" value="{{ old('quantity', $product->quantity) }}"  placeholder="Enter quantity name" style= "background-color:white !important; color: black;" >
            <label class="sr-only-visible" for="inlineFormInputName2">Product Categories</label>
                  <select  class="form-control" name="category_id"    id="permissions" style= "background-color:white !important; color: black !important;">
                    @foreach ($categories as  $category)
                      <option value="{{ $category->id }}" {{  $category->id===$product->category_id ? 'selected' : '' }} >{{ $category->name }}</option>
                    @endforeach
                  </select>
            <label class="sr-only-visible" for="inlineFormInputName2">Image</label>
            <input type="file" class="form-control"   name="image"   style= "background-color:white !important; color: black;" >
                  <img src="/productImage/{{ $product->image }}" alt="{{ $product->title }}" height="60px" class="mb-2 mt-2">
            <br>
            <button type="submit" class="btn btn-primary mb-2">Submit</button>
        </form>
    </div>
</div>
</div>
@endcomponent

