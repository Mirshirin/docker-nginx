@component('admin.layouts.content')
@section('scripts')

<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.deletebtn').click(function (e) { 
            e.preventDefault();
            var delete_id = $(this).closest("tr").find('.delete_val_id').val();

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var data = {
                        "_token": $('input[name=_token]').val(),
                        "id": delete_id
                    }

                    $.ajax({
                        type: "DELETE",
                        url: '/admin/delete-category/' + delete_id,
                        data: data,
                        success: function (response) {
                            swal(response.status, {
                                icon: "success",
                            }).then((result) => {
                                location.reload();
                            });
                        }       
                    });
                }
            });
        });
    });
</script>
@endsection

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">

    <div class="card-body">
        <div class="d-flex justify-content-between">
          <h4 class="card-title">Category List</h4>
            <div>
              @can('create-category')
              <a class="nav-link btn btn-sm btn-success  " href="{{ route('create-category') }}">+ Create  Category</a>
              @endcan
            </div>
        </div>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th> # </th>
              <th>Category name </th>
              <th> Action </th>
            </tr>
          </thead>
          <tbody>
          @foreach ( $categories as $category)
            <tr class="item_type category">
                <input type="hidden" class="delete_val_id" value="{{ $category->id }}">
                <td> {{  $category->id }} </td>
                <td> {{ $category->name }}</td>
                <td>
                  @can('edit-category')
                  <a href="{{ route('edit-category',$category->id ) }}" class="btn btn-sm btn-info">Edit</a>
                  @endcan
                  @can('delete-category')
                  <button type="submit" class="btn btn-sm btn-danger deletebtn" ">Delete</button>
                  @endcan
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endcomponent
