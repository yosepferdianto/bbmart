<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use App\Branchs;
use App\Http\Requests\CabangRequest;
class CabangController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        if(request()->ajax()){
            $pages = Branchs::all();

            return datatables()->of($pages)
                ->addColumn('action', function ($row) {
                    $action = '';

                    $action.= '<a href="javascript:;" data-row-id="' . $row->id . '" class="btn btn-primary btn-circle edit-cabang"
                      data-toggle="tooltip" data-original-title="'.__('app.edit').'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

               
                        $action.= ' <a href="javascript:;" class="btn btn-danger btn-circle delete-row"
                          data-toggle="tooltip" data-row-id="' . $row->id . '" data-original-title="'.__('app.delete').'"><i class="fa fa-times" aria-hidden="true"></i></a>';
             
                    return $action;
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('admin.cabang.index');   
    }

    public function json(){
        return Datatables::of(Branchs::all())->make(true);
    }

    public function store(CabangRequest $request){
        $branchs = new Branchs();

        $branchs->kode_cabang       = $request->kode_cabang;
        $branchs->nama_cabang       = $request->nama_cabang;
        $branchs->alamat_cabang     = $request->alamat_cabang;
        $branchs->longitude_cabang  = $request->longitude_cabang;
        $branchs->latitude_cabang   = $request->latitude_cabang;

        $branchs->save();

        $notification = array(
            'message' => 'Data Cabang Berhasil Ditambahkan!',
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }

    public function edit($id)
    {
        $branchs = Branchs::where('id', $id)->firstOrFail();
        return view('admin.cabang.edit', compact('branchs'));
    }

    public function update(CabangRequest $request, $id)
    {
        $branchs = Branchs::where('id', $id)->firstOrFail();

        $branchs->kode_cabang       = $request->kode_cabang;
        $branchs->nama_cabang       = $request->nama_cabang;
        $branchs->alamat_cabang     = $request->alamat_cabang;
        $branchs->longitude_cabang  = $request->longitude_cabang;
        $branchs->latitude_cabang   = $request->latitude_cabang;

        $branchs->update();

        $notification = array(
            'message' => 'Data Cabang Berhasil Diubah!',
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }

    public function destroy($id)
    {
        Branchs::destroy($id);

        $notification = array(
            'message' => 'Data Cabang Berhasil Dihapus!',
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }

}
