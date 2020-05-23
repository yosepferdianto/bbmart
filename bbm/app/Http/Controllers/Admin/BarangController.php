<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Barang;
use App\Satuan;
use App\Categories;
use App\Http\Requests\BarangRequest;
use DB;

class BarangController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        abort_if(!auth()->user()->hasPermissionTo('barang'), 403);
        if(request()->ajax()){
            $barang = Barang::all();
            return datatables()->of($barang)
                ->addColumn('action', function ($row) {
                    $action = '';        
                    if(auth()->user()->hasPermissionTo('edit_barang')){
                    $action.= '<a href="' . route('admin.barang.edit', [$row->id]) . '"class="btn btn-primary btn-circle btn-sm"
                      data-toggle="tooltip" data-original-title="'.__('app.edit').'"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>';
                    }
                    if(auth()->user()->hasPermissionTo('delete_barang')){
                    $action.= ' <a href="javascript:;" class="btn btn-danger btn-circle btn-sm delete-row"
                          data-toggle="tooltip" data-row-id="' . $row->id . '" data-original-title="'.__('app.delete').'"><i class="fa fa-times" aria-hidden="true"></i></a>';
                    }
                    
                    return $action;
                    
                })
                ->addColumn('harga', function ($row) {
                    $harga = '<label class="badge badge-danger">Rahasia</label>';
                    if(auth()->user()->hasPermissionTo('value_barang')){
                        $harga= $row->harga_beli;
                    }
                    return $harga;
                    
                })
                ->editColumn('kode_satuan', function ($row) {
                    return $row->satuan->nama_satuan;
                })
                ->editColumn('kode_kategori', function ($row) {
                    return $row->categories->nama_kategori;
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'harga'])
                ->toJson();
        }
        return view('admin.barang.index');   
    }

    public function create()
    {
        $satuan = Satuan::orderBy('id', 'ASC')->get();
        $kategori = Categories::orderBy('id', 'ASC')->get();
        return view ('admin.barang.create', compact('satuan', 'kategori'));
    }

    public function store(BarangRequest $request){
        $barang = new Barang();

        $barang->kode_barang         = $request->kode_barang;
        $barang->nama_barang         = $request->nama_barang;
        $barang->kode_kategori       = $request->kode_kategori;
        $barang->kode_satuan         = $request->kode_satuan;
        $barang->komisi              = $request->komisi;
        $barang->user_id             = $request->user_id;
        $barang->harga_beli          = $request->harga_beli;
        $barang->harga_jual          = $request->harga_jual;
        $barang->save();

        $notification = array(
            'message' => 'Data Barang Berhasil Ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect('/account/barang')->with($notification);
    }

    public function edit($id)
    {
        $barang = Barang::where('id', $id)->firstOrFail();
        $satuan = Satuan::orderBy('id', 'ASC')->get();
        $kategori = Categories::orderBy('id', 'ASC')->get();
        return view('admin.barang.edit', compact('barang', 'satuan', 'kategori'));
    }

    public function destroy($id)
    {
        Barang::destroy($id);
        $notification = array(
            'message' => 'Data Barang Berhasil Dihapus!',
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }

    public function update(BarangRequest $request, $id)
    {
        $barang = Barang::where('id', $id)->firstOrFail();

        $barang->kode_barang         = $request->kode_barang;
        $barang->nama_barang         = $request->nama_barang;
        $barang->kode_kategori       = $request->kode_kategori;
        $barang->kode_satuan         = $request->kode_satuan;
        $barang->komisi              = $request->komisi;
        $barang->user_id             = $request->user_id;
        $barang->harga_beli          = $request->harga_beli;
        $barang->harga_jual          = $request->harga_jual;
        $barang->save();

        $notification = array(
            'message' => 'Data Barang Berhasil Diubah!',
            'alert-type' => 'success'
        );
        
        return redirect('/account/barang')->with($notification);
    }

    public function searchBarang(Request $request){
        $searchTerm = $request->q;
        $users = DB::table('barang')->select('barang.id', 'kode_barang', 'nama_barang', 'nama_satuan', 'harga_beli')->join('satuan', 'barang.kode_satuan', '=', 'satuan.id')->where('nama_barang', 'like', $searchTerm.'%')->get();

        return response()->json($users);
    }

}
