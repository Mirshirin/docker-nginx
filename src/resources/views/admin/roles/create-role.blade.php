@component('admin.layouts.content')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
      $(document).ready(function() {
         $('#permissions').select2(
            {
                'placeholder':'please select some permission'
            }
         );
      });
    </script>
@endsection
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      @include('admin.layouts.errors')
    <h4 class="card-title">Create Role</h4>   
    <form id="frm" class="form-inline" method="POST" action="{{ route('store-role') }}">
        @csrf
      <label class="sr-only-visible" for="inlineFormInputName2">Role Name</label>
      <input type="text" class="form-control mb-2 mr-sm-2" name="name"  placeholder="Enter role name" style= "background-color:white !important; color: black;" >
      <label class="sr-only-visible" for="inlineFormInputName2">Role Label</label>
      <input type="text" class="form-control mb-2 mr-sm-2" name="label"  placeholder="Enter role label" style= "background-color:white !important; color: black;" >      <br>
      <label class="sr-only-visible" for="inlineFormInputName2">Role and permissions</label>
        <select name="permissions[]" id="permissions" class="form-control"  style= "background-color:white !important; color: black;" multiple >
            @foreach ($permissions as $permission) 
            <option value="{{ $permission->id }} "> {{ $permission->name }} - {{ $permission->label }} </option>      
            @endforeach        
        </select>        
      <button type="submit" class="btn btn-primary mb-2">Submit</button>
    </form>
  </div>
</div>
</div>
@endcomponent
