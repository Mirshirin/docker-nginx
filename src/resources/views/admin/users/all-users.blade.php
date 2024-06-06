@component('admin.layouts.content')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">

    <div class="card-body">
        <div class="d-flex justify-content-between">
          <h4 class="card-title">Users List</h4>
            <div>
              @can('create-user')
              <a class="nav-link btn btn-sm btn-success" href="{{ route('create-user') }}" >+ Create  User</a>
              @endcan
            </div>
        </div>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th> # </th>
              <th>Name </th>
              <th>Email </th>
              <th>Phone </th>
              <th>Address </th>
              <th>Email status</th>  
              <th> Action </th>
            </tr>
          </thead>
          <tbody>
          @foreach ( $users as $user)
            <tr class="item_type user">
                <input type="hidden" class="delete_val_id" value="{{ $user->id }}">
                <td> {{  $user->id }} </td>
                <td> {{ $user->name }}</td>
                <td> {{ $user->email }}</td>
                <td> {{ $user->phone }}</td>
                <td> {{ $user->address }}</td>
                <td>
                  @if ( $user->email_verified_at)
                    Active
                  @else 
                    Inactive                      
                  @endif                
                </td>
                <td> 
                  @can('delete-user')
                  <button type="submit" class="btn btn-sm btn-danger deletebtn" ">Delete</button>
                  @endcan  
                  @can('edit-user')
                  <a href="{{ route('edit-user',$user->id ) }}" class="btn btn-sm btn-info">Edit</a>  
                  @endcan     
                  @if($user->isStaffUser())                    
                    @can('staff-user-permission')
                    <a href ="{{ route('users.permissions' ,$user->id) }}" class="btn btn btn-info">Access </a>
                    @endcan
                  @endif
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
       
     
    </div>
    
  </div>
  <div class="note">
    <div class="note-body">
      {{ $users->links() }}
    </div>
  </div>
  
</div>


@endcomponent
