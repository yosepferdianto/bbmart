<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Keuangan;
use DataTables;
use App\Http\Requests\KeuanganRequest;

class KeuanganController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        if(request()->ajax()){
            $keuangan = Keuangan::all();

            return datatables()->of($keuangan)
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

        return view('admin.keuangan.index');   
    }

    public function create()
    {
        return view('admin.keuangan.create');
    }

    public function store(KeuanganRequest $request){
        $keuangan = new Keuangan();

        $keuangan->nama_bank        = $request->nama_bank;
        $keuangan->cabang_bank      = $request->cabang_bank;
        $keuangan->nama_rekening    = $request->nama_rekening;
        $keuangan->no_rekening      = $request->no_rekening;
        $keuangan->save();

        $notification = array(
            'message' => 'Data Bank Berhasil Ditambahkan!',
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }
}
