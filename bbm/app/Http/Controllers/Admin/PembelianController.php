<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pembelian;
use App\Helper\Autonumber;
use App\Warehouses;

class PembelianController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        if(request()->ajax()){
            $rows = Pembelian::all();
            return datatables()->of($rows)
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
        return view('admin.pembelian.index');   
    }

    public function create()
    {
        $nomer = Autonumber::getNomerPO();
        return view('admin.pembelian.create', compact('nomer'));
    }
}
