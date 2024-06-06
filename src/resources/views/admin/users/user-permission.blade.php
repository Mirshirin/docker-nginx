@component('admin.layouts.content')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
      $(document).ready(function() {
         $('#roles').select2(
            {
                'placeholder':'please select some roles'
            }
         );
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
        <h4 class="card-title">User permission and Role List</h4>

        <form id="frm" class="form-inline" method="POST" action="{{ route('users.permissions.store',$user->id) }}">
            @csrf            
                  
            <label class="sr-only-visible" for="inlineFormInputName2">Role List</label>
            <select name="permissions[]" id="roles" class="form-control" style= "background-color:white !important; color: black;" multiple >
                @foreach ($roles as $role) 
                <option value="{{ $role->id }} " {{ in_array($role->id,$user->roles->pluck('id')->toArray()) ? 'selected' : '' }} >{{ $role->name }} - {{ $role->label }} </option> 
                @endforeach                
            </select>
            <label class="sr-only-visible" for="inlineFormInputName2">Permisssion List</label>
            <select name="permissions[]" id="permissions" class="form-control" style= "background-color:white !important; color: black;" multiple >
                @foreach ($permissions as $permission) 
                <option value="{{ $permission->id }} " {{ in_array($permission->id,$user->permissions->pluck('id')->toArray()) ? 'selected' : '' }} >{{ $permission->name }} - {{ $permission->label }} </option> 
                @endforeach                
            </select>
            <button type="submit" class="btn btn-primary mb-2">Submit</button>
        </form>
    </div>
</div>
</div>
@endcomponent

