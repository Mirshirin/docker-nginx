@component('admin.layouts.content')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">

    <div class="card-body">
        <div class="d-flex justify-content-between">
          <h4 class="card-title">Permission List</h4>
            <div>
              @can('create-permission')
              <a class="nav-link btn btn-sm btn-success  " href="{{ route('create-permission') }}">+ Create  permission</a>
              @endcan
            </div>
        </div>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th> # </th>
              <th>Permission name </th>
              <th>Permission label</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach ( $permissions as $permission)
            <tr class="item_type permission">
                <input type="hidden" class="delete_val_id" value="{{ $permission->id }}">
                <td> {{  $permission->id }} </td>
                <td> {{ $permission->name }}</td>
                <td> {{ $permission->label }}</td>
                <td>
                  @can('edit-permission')
                  <a href="{{ route('edit-permission',$permission->id ) }}" class="btn btn-sm btn-info">Edit</a>
                  @endcan
                  @can('delete-permission')
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
        {{ $permissions->links() }}
      </div>
    </div>
  </div>
  
</div>
@endcomponent
