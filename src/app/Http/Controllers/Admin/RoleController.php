<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-roles')->only(['allRole']);
        $this->middleware('can:create-role')->only(['createRole','storeRole']); 
        $this->middleware('can:edit-role')->only(['editRole','updateRole']);  
        $this->middleware('can:delete-role')->only(['deleteRole']);
    }
    public function allRole(){
        $roles=Role::all();
        return view('admin.roles.all-role')->with('roles',$roles);
    }
    public function createRole(){
        $permissions=Permission::all();
        return view('admin.roles.create-role')->with('permissions',$permissions);
    }
    public function storeRole(Request $request){
        $data=$request->validate([
            'name' => ['required','string','max:255'],
            'label' => ['nullable','string','max:255'],
            'permissions'=> ['required', 'array'],
        ]);
    
        $role=Role::create($data);
        $role->permissions()->sync($data['permissions']);
        return redirect(route('all-roles'))->with('message','Data saved.');
    }
    public function editRole($id){
        $role=Role::find($id);
        $permissions=Permission::all();

        return view('admin.roles.edit-role')->with('role',$role)->with('permissions',$permissions);
    }
    public function updateRole(Request $request,$id){
        $role=Role::find($id);
        $data=$request->validate([
            'name' => ['required','string','max:255'],    
            'label' => ['nullable','string','max:255'],
            'permissions'=> ['required', 'array'],
        ]);
        $role->update($data);
        $role->permissions()->sync($data['permissions']);

        return redirect(route('all-roles'))->with('message','Data updated.');
    }
    
    public function deleteRole($id){
        $role=Role::find($id);
        $role->delete();
        return response()->json(['status'=> 'Data deleted successfully.']);
    }
}
