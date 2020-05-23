<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\VendorRequest;

class VendorController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        abort_if(!auth()->user()->hasPermissionTo('vendor'), 403);
        if(request()->ajax()){
            $user = User::role('Vendor');
            return datatables()->of($user)
                ->addColumn('action', function ($row) {
                    $action = '';
                    if(auth()->user()->hasPermissionTo('edit_vendor')){
                    $action.= '<a href="' . route('admin.satuan.edit', [$row->id]) . '"class="btn btn-primary btn-circle btn-sm"
                      data-toggle="tooltip" data-original-title="'.__('app.edit').'"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>';
                    }
                    if(auth()->user()->hasPermissionTo('delete_vendor')){
                    $action.= ' <a href="javascript:;" class="btn btn-danger btn-circle btn-sm delete-row"
                          data-toggle="tooltip" data-row-id="' . $row->id . '" data-original-title="'.__('app.delete').'"><i class="fa fa-times" aria-hidden="true"></i></a>';
                    }
                    return $action;
                })
                ->editColumn('status', function ($row) {
                    if($row->status == '1'){
                        return '<label class="badge badge-success">Aktif</label>';
                    } else {
                        return '<label class="badge badge-danger">Non-Aktif</label>';
                    }
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'status'])
                ->toJson();
        }
        return view('admin.vendor.index');   
    }

    public function create(){
        return view('admin.vendor.create');
    }

    public function store(Request $request){
        $user = new User();

        $user->kode                = $request->kode_vendor;
        $user->name                = $request->nama_vendor;
        $user->alamat              = $request->alamat_vendor;
        $user->npwp                = $request->npwp_vendor;
        $user->email               = $request->email_vendor;
        $user->pic                 = $request->pic_vendor;
        $user->telp                = $request->telp_vendor;
        $user->no_va               = $request->no_va;

        $user->password = bcrypt('123456');
        $user->assignRole('Vendor');
        $user->save();

        $notification = array(
            'message' => 'Data Vendor Berhasil Ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect('/account/vendor')->with($notification);
    }

    public function destroy($id)
    {
        User::destroy($id);
        $notification = array(
            'message' => 'Data Vendor Berhasil Dihapus!',
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }

    public function show($id)
    {
        $customer = User::findOrFail($id);

        return view('admin.vendor.ajax_show', compact('customer'));

    }
}
