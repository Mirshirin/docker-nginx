<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Permission;


class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-permissions')->only(['allPermission']);
        $this->middleware('can:create-permission')->only(['createPermission','storePermission']); 
        $this->middleware('can:edit-permission')->only(['editPermission','updatePermission']);  
        $this->middleware('can:delete-permission')->only(['deletePermission']);
    }
    public function allPermission(){

        $permissions = Permission::paginate(7);
        //dd($permissions);
        return view('admin.permissions.all-permission')->with('permissions',$permissions);
    
    }
    
    public function createPermission(){
    
        // $permissions = Permission::query();
    
        return view('admin.permissions.create-permission');
    
    }
    
    public function storePermission(Request $request){
    
      
        $data =
        $request->validate([
            'name' => ['required','string','max:255',Rule::unique(Permission::class)->ignore($request->id)],
            'label' => ['nullable','string','max:255',Rule::unique(Permission::class)->ignore($request->id)],

        ]);
   
     Permission::create($data);
   

        return redirect(route('all-permission'))->with('message','permission was stored');
    
    }
    
    public function editPermission($id){
    
        $permission=Permission::find($id);
    
        return view('admin.permissions.edit-permission')->with('permission',$permission);
    
    }
    public function updatePermission(Request $request, $id)
    {  
        $permission= Permission::find($id);
        
        $data =
            $request->validate([
                
                'name' => ['required','string','max:255',Rule::unique(Permission::class)->ignore($request->id)],
                'label' => ['nullable','string','max:255',Rule::unique(Permission::class)->ignore($request->id)],
            ]);
         
            $permission->update($data);  
           
        return to_route('all-permission',$permission)->with('message','Permission was updated.');
    }
    public function deletePermission($id)
    {
        $permission=Permission::find($id);
        
        $permission->delete();
        return response()->json([ 'status' => 'Permission deleted successfully' ]);
    }
     
}
