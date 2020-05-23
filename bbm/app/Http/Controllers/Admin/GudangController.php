<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gudang;
use App\Warehouse;
use App\Http\Requests\GudangRequest;

class GudangController extends Controller
{
    public function index(){
        if(request()->ajax()){
            $keuangan = Gudang::all();

            return datatables()->of($keuangan)
                ->addColumn('action', function ($row) {
                    $action = '';

                    $action.= '<a href="' . route('admin.gudang.edit', [$row->id]) . '"class="btn btn-primary btn-circle"
                      data-toggle="tooltip" data-original-title="'.__('app.edit').'"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>';
                    $action.= ' <a href="' . route('admin.gudang.show', [$row->id]) . '" class="btn btn-light"><i class="fa fa-eye" aria-hidden="true"></i></a>';
             
                    return $action;
                })
                ->addIndexColumn()
                ->editColumn('jenis_gudang', function ($row) {
                    if ($row->jenis_gudang == '1') {
                        return 'Tangki';
                    } else {
                        return 'Non Tangki';
                    }
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('admin.gudang.index');   
    }

    public function create()
    {
        $warehouse = Warehouse::orderBy('id', 'ASC')->get();
        return view('admin.gudang.create', compact('warehouse'));
    }

    public function edit($id)
    {
        $gudang = Gudang::where('id', $id)->firstOrFail();
        $warehouse = Warehouse::orderBy('id', 'ASC')->get();
        return view('admin.gudang.edit', compact('gudang', 'warehouse'));
    }

    public function show($id)
    {
        $gudang = Gudang::where('id', $id)->firstOrFail();
        $warehouse = Warehouse::orderBy('id', 'ASC')->get();
        
        return view('admin.gudang.detail', compact('gudang', 'warehouse'));
    }

    public function store(GudangRequest $request){
        $gudang = new Gudang();

        $gudang->kode_gudang         = $request->kode_gudang;
        $gudang->nama_gudang         = $request->nama_gudang;
        $gudang->kode_warehouse      = $request->kode_warehouse;
        $gudang->jenis_gudang        = $request->jenis_gudang;
        $gudang->kapasitas_gudang    = $request->kapasitas_gudang;
        $gudang->save();

        $notification = array(
            'message' => 'Data Gudang Berhasil Ditambahkan!',
            'alert-type' => 'success'
        );
        
        return redirect('/account/gudang')->with($notification);
    }

    public function update(GudangRequest $request, $id)
    {
        $gudang = Gudang::where('id', $id)->firstOrFail();

        $gudang->kode_gudang         = $request->kode_gudang;
        $gudang->nama_gudang         = $request->nama_gudang;
        $gudang->kode_warehouse      = $request->kode_warehouse;
        $gudang->jenis_gudang        = $request->jenis_gudang;
        $gudang->kapasitas_gudang    = $request->kapasitas_gudang;
        $gudang->save();

        $notification = array(
            'message' => 'Data Cabang Berhasil Diubah!',
            'alert-type' => 'success'
        );
        
        return redirect('/account/gudang')->with($notification);
    }

    public function destroy($id)
    {
        Gudang::destroy($id);

        $notification = array(
            'message' => 'Data Cabang Berhasil Dihapus!',
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }
}
