<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
class RoleController extends Controller
{
    function role_manager(){
      // $permission = Permission::create(['name' => 'delete product']);
      return view('cit.role.index',[
        'roles' => Role::all(),
        'permissions' => Permission::all(),
        'users' => User::where('role', 1)->get()
      ]);
    }
    function add_role(Request $request){
      $request->validate([
        'role_name' => 'unique:roles,name'
      ]);
      //role create
      $role = Role::create(['name' => $request->role_name]);
      //permission assign
      $role->givePermissionTo($request->permission);
      return back();
    }
    function assign_role(Request $request){

      $user = User::find($request->user_id);
      $user->assignRole($request->role_name);
      return back();
    }
    function role_permission_edit($user_id){
      return view('cit.role.role_permission_edit',[
          'permissions' => Permission::all(),
          'user'=> User::find($user_id)
      ]);
    }
    function change_permission_edit(Request $request){
      
      $user = User::find($request->user_id);
      $user->syncPermissions($request->permission);
      return back();
    }
}
