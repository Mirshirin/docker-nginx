
@component('admin.layouts.content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
@if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch(type){
        case 'info':
        toastr.info("{{ Session::get('message') }}");
        break;
        case 'success':
        toastr.success("{{ Session::get('message') }}");
        break;  
        case 'warning':
        toastr.warning("{{ Session::get('message') }}");
        break; 
        case 'error':
        toastr.error("{{ Session::get('message') }}");
        break;      
    }
@endif
</script>
    <div class="card-body">
        <h4 class="card-title">Edit User</h4>

        <form id="frm--" class="form-inline" method="POST" action="{{ route('update-password') }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <label class="form-label" for="name">old password</label>
            <input type="password" class="form-control @error('old_password') is-invalid @enderror mb-2 mr-sm-2"  
            id="old_password" name="old_password" 
            placeholder="Enter old Password "               
            style= "background-color:white !important; color: black;" autocomplete="off" > 
            @error('old_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror  
            <br>          
            <label class="sr-only-visible" for="name">New Password</label>
            <input type="password" class="form-control @error('new_password') is-invalid @enderror mb-2 mr-sm-2"  
            id="new_password" name="new_password"  
            placeholder="Enter new Password "         
            style= "background-color:white !important; color: black;" autocomplete="off" > 
            @error('new_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror 
            <br>         
            <label class="form-label" for="name">Password Confirmation</label>
            <input type="password" class="form-control"  
            id="new_password_confirmation" name="new_password_confirmation"  
            placeholder="Enter Password confirmation"        
            style= "background-color:white !important; color: black;" autocomplete="off" > 
                 
            <br> 
          
            <button type="submit" class="btn btn-primary mb-2">Update Password</button>
            
        </form>
    </div>

@endcomponent
