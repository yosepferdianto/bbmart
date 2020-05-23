<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Satuan;
use App\Http\Requests\SatuanRequest;

class SatuanController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        if(request()->ajax()){
            $satuan = Satuan::all();
            return datatables()->of($satuan)
                ->addColumn('action', function ($row) {
                    $action = '';

                    $action.= '<a href="' . route('admin.satuan.edit', [$row->id]) . '"class="btn btn-primary btn-circle"
                      data-toggle="tooltip" data-original-title="'.__('app.edit').'"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>';
                    $action.= ' <a href="javascript:;" class="btn btn-danger btn-circle delete-row"
                          data-toggle="tooltip" data-row-id="' . $row->id . '" data-original-title="'.__('app.delete').'"><i class="fa fa-times" aria-hidden="true"></i></a>';
             
                    return $action;
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('admin.satuan.index');   
    }

    public function create()
    {
        return view ('admin.satuan.create');
    }

    public function store(SatuanRequest $request){
        $satuan = new Satuan();

        $satuan->kode_satuan         = $request->kode_satuan;
        $satuan->nama_satuan         = $request->nama_satuan;
        $satuan->save();

        $notification = array(
            'message' => 'Data Satuan Berhasil Ditambahkan!',
            'alert-type' => 'success'
        );
        
        return redirect('/account/satuan')->with($notification);
    }

    public function edit($id)
    {
        $satuan = Satuan::where('id', $id)->firstOrFail();
        return view('admin.satuan.edit', compact('satuan'));
    }

    public function destroy($id)
    {
        Satuan::destroy($id);
        $notification = array(
            'message' => 'Data Gudang Berhasil Dihapus!',
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }

    public function update(SatuanRequest $request, $id)
    {
        $satuan = Satuan::where('id', $id)->firstOrFail();

        $satuan->kode_satuan         = $request->kode_satuan;
        $satuan->nama_satuan         = $request->nama_satuan;
        $satuan->save();

        $notification = array(
            'message' => 'Data Satuan Berhasil Diubah!',
            'alert-type' => 'success'
        );
        
        return redirect('/account/satuan')->with($notification);
    }

}
