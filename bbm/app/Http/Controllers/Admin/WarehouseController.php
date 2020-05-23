<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Warehouse;
use App\Branchs;
use App\Gudang;
use App\Http\Requests\WarehouseRequest;
use DB;

class WarehouseController extends Controller
{
    public function index()
    {
        $branchs = Branchs::orderBy('id', 'ASC')->get();
        
        if(request()->ajax()){
            $warehouse = Warehouse::select([
                'warehouses.kode_warehouse',
                'warehouses.nama_warehouse',
                'warehouses.kode_cabang',
                \DB::raw('count(gudang.kode_warehouse) as count')
                ])->leftjoin('gudang', 'gudang.kode_warehouse', '=', 'warehouses.kode_warehouse')
                ->groupBy('warehouses.kode_warehouse');
            return datatables()->of($warehouse)
                ->addColumn('action', function ($row) {
                    $action = '';

                    $action.= '<a href="javascript:;" data-row-id="' . $row->id . '" class="btn btn-primary btn-circle edit-cabang"
                      data-toggle="tooltip" data-original-title="'.__('app.edit').'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

               
                      $action.= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
             
                    return $action;
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('admin.warehouse.index', compact('branchs'));
    }

    public function create(){
        $branchs = Branchs::orderBy('id', 'ASC')->get();
        return view('admin.warehouse.create', compact('branchs'));
    }

    public function store(WarehouseRequest $request){
        $warehouse = new Warehouse();

        $warehouse->kode_warehouse       = $request->kode_warehouse;
        $warehouse->nama_warehouse    = $request->nama_warehouse;
        $warehouse->kode_cabang      = $request->kode_cabang;
        $warehouse->longitude_warehouse  = $request->longitude_warehouse;
        $warehouse->latitude_warehouse   = $request->latitude_warehouse;
        $warehouse->alamat_warehouse = $request->alamat_warehouse;

        $warehouse->save();

        $notification = array(
            'message' => 'Data Warehouse Berhasil Ditambahkan!',
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }

    public function destroy($id)
    {
        Warehouse::destroy($id);

        $notification = array(
            'message' => 'Data Warehouse Berhasil Dihapus!',
            'alert-type' => 'success'
        );
        
        return with($notification);
    }

    public function searchWarehouse(Request $request){
        $searchTerm = $request->q;
        $users = DB::table('warehouses')->select('id', 'nama_warehouse', 'kode_warehouse')->where('nama_warehouse', 'like', $searchTerm.'%')
            ->get();

        return response()->json($users);
    }
}
