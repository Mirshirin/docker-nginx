@component('admin.layouts.content')

    <div class="card-body">
        <h4 class="card-title">Edit User</h4>

        <form id="frm" class="form-inline" method="POST" action="{{ route('update-user',$user->id) }}">
            @csrf
            @method('patch')
            <label class="sr-only-visible" for="name">Name</label>
            <input type="text" class="form-control mb-2 mr-sm-2"  id="name" name="name"  value="{{ old('name', $user->name) }}" style= "background-color:white !important; color: black;" >
            <label class="sr-only-visible" for="email">Email address</label>
            <input type="email" class="form-control mb-2 mr-sm-2"  id="email" name="email"   value="{{ old('email', $user->email) }}" style= "background-color:white !important; color: black;" >
            <label class="sr-only-visible" for="password">Password</label>
            <input type="password" class="form-control mb-2 mr-sm-2" id="password" name="password" placeholder="Enter Password "  style= "background-color:white !important; color: black;" >
            <label class="sr-only-visible" for="password_confirmation">Password Confirmation</label>
            <input type="password" class="form-control mb-2 mr-sm-2" id="password_confirmation" name="password_confirmation"  placeholder="Enter Password confirmation" style= "background-color:white !important; color: black;" >
            <label class="sr-only-visible" for="phone">Phone No.</label>
            <input type="text" class="form-control mb-2 mr-sm-2"   id="phone" name="phone"   value="{{ old('phone', $user->phone) }}" style= "background-color:white !important; color: black;" >
            <label class="sr-only-visible" for="address">address</label>
            <input type="text" class="form-control mb-2 mr-sm-2"  id="address" name="address"  placeholder="Enter address"   value="{{ old('address', $user->address) }}" style= "background-color:white !important; color: black;" >
            @if (! $user->hasVerifiedEmail())
                <label class="sr-only-visible" for="verify">User Verification</label>
                <input type="checkbox" class="form-check-input"  id="verify" name="verify" >
               
            @endif
            
            {{-- <div class="mb-3 row"> --}}
              <label for="roles" class="sr-only-visible">Roles</label>
              {{-- <div class="col-md-6">            --}}
                  <select class="form-select @error('roles') is-invalid @enderror"  aria-label="Roles" id="roles" name="roles[]">
                      @forelse ($roles as $role)

                          @if ($role!='superadmin')
                          <option value="{{ $role }}" {{ in_array($role, $userRoles ?? []) ? 'selected' : '' }}>
                              {{ $role }}
                          </option>
                            
                          @endif

                      @empty

                      @endforelse
                  </select>
                  @if ($errors->has('roles'))
                      <span class="text-danger">{{ $errors->first('roles') }}</span>
                  @endif
              {{-- </div> --}}
          {{-- </div> --}}
          <br>
            <button type="submit" class="btn btn-primary mb-2">Submit</button>
            
        </form>
    </div>
@endcomponent
