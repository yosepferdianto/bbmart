<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller as BaseController;
use Spatie\Permission\Models\Role;
use DB;
use Spatie\Permission\Models\Permission;

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request){
        $data = User::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.user.index', compact('data'));
    }
    
    public function create()

    {
        $roles = Role::orderBy('name', 'ASC')->get();
        return view('admin.user.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roles' => 'required|string|exists:roles,name'
        ]);
        $user = User::firstOrCreate([
            'email' => $request->email
        ], [
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'status' => 'Aktif'
        ]);
        $user->assignRole($request->roles);

        $notification = array(
            'message' => 'Data User Berhasil Ditambahkan!',
            'alert-type' => 'success'
        );
        
        return redirect('/account/users')->with($notification);
    }

    public function edit($id)
    {
        $users = User::find($id);
        $roles = Role::orderBy('name', 'ASC')->get();
        $userRole = $users->roles->pluck('name','name')->all();

        return view('admin.user.edit', compact('users', 'roles', 'userRole'));
    }

    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('admin.user.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|exists:users,email',
            'password' => 'nullable|min:6',
            'roles' => 'required'
        ]);
        $user = User::findOrFail($id);
        $password = !empty($request->password) ? bcrypt($request->password):$user->password;
        $user->update([
            'name' => $request->name,
            'password' => $password
        ]);

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));

        $notification = array(
            'message' => 'Data User Berhasil Diubah!',
            'alert-type' => 'success'
        );
        
        return redirect('/account/users')->with($notification);
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        $notification = array(
            'message' => 'Data User Berhasil Dihapus!',
            'alert-type' => 'success'
        );
        return redirect('/account/users')->with($notification);
    }

    public function rolePermission(Request $request)
    {
        $role = $request->get('role');
        //Default, set dua buah variable dengan nilai null
        $permissions = null;
        $hasPermission = null;
        //Mengambil data role
        $roles = Role::all()->pluck('name');
        //apabila parameter role terpenuhi
        if (!empty($role)) {
            //select role berdasarkan namenya, ini sejenis dengan method find()
            $getRole = Role::findByName($role);
            //Query untuk mengambil permission yang telah dimiliki oleh role terkait
            $hasPermission = DB::table('role_has_permissions')
                ->select('permissions.name')
                ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                ->where('role_id', $getRole->id)->get()->pluck('name')->all();
            
            //Mengambil data permission
            $permissions = Permission::all()->pluck('name');
        }
        return view('admin.user.role_permission', compact('roles', 'permissions', 'hasPermission'));
    }

    public function setRolePermission(Request $request, $role)
    {
        //select role berdasarkan namanya
        $role = Role::findByName($role);
        
        //fungsi syncPermission akan menghapus semua permissio yg dimiliki role tersebut
        //kemudian di-assign kembali sehingga tidak terjadi duplicate data
        $role->syncPermissions($request->permission);

        $notification = array(
            'message' => 'Hak Akses Berhasil Diubah!',
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }

    public function addPermission(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:permissions'
        ]);
        $permission = Permission::firstOrCreate([
            'name' => $request->name
        ]);
        $permission = Permission::firstOrCreate([
            'name' => 'create_'.$request->name
        ]);
        $permission = Permission::firstOrCreate([
            'name' => 'edit_'.$request->name
        ]);
        $permission = Permission::firstOrCreate([
            'name' => 'delete_'.$request->name
        ]);
        $permission = Permission::firstOrCreate([
            'name' => 'value_'.$request->name
        ]);
        $notification = array(
            'message' => 'Modul Hak Akses Berhasil Ditambah!',
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }
}
