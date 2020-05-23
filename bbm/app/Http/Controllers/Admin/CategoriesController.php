<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categories;
use App\Http\Requests\CategoriesRequest;
use App\Helper\Reply;


class CategoriesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        if(request()->ajax()){
            $kategori = Categories::all();

            return datatables()->of($kategori)
                ->addColumn('action', function ($row) {
                    $action = '';

                    $action.= '<a href="' . route('admin.categories.edit', [$row->id]) . '"class="btn btn-primary btn-circle"
                      data-toggle="tooltip" data-original-title="'.__('app.edit').'"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>';
                    $action.= ' <a href="javascript:;" class="btn btn-danger btn-circle delete-row"
                          data-toggle="tooltip" data-row-id="' . $row->id . '" data-original-title="'.__('app.delete').'"><i class="fa fa-times" aria-hidden="true"></i></a>';
             
                    return $action;
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('admin.kategori.index');   
    }

    public function create()
    {
        return view ('admin.kategori.create');
    }

    public function store(CategoriesRequest $request){
        $kategori = new Categories();

        $kategori->kode_kategori         = $request->kode_kategori;
        $kategori->nama_kategori         = $request->nama_kategori;
        $kategori->save();

        $notification = array(
            'message' => 'Data Kategori Berhasil Ditambahkan!',
            'alert-type' => 'success'
        );
        
        return redirect('/account/categories')->with($notification);
    }

    public function edit($id)
    {
        $kategori = Categories::where('id', $id)->firstOrFail();
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function destroy($id)
    {
        Categories::destroy($id);
        $notification = array(
            'message' => 'Data Gudang Berhasil Dihapus!',
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }

    public function update(CategoriesRequest $request, $id)
    {
        $kategori = Categories::where('id', $id)->firstOrFail();

        $kategori->kode_kategori         = $request->kode_kategori;
        $kategori->nama_kategori         = $request->nama_kategori;
        $kategori->save();

        $notification = array(
            'message' => 'Data Kategori Berhasil Diubah!',
            'alert-type' => 'success'
        );
        
        return redirect('/account/categories')->with($notification);
    }
}
