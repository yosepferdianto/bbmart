<?php

namespace App\Http\Controllers\Admin;

use App\CompanySetting;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\SettingRequest;
use Illuminate\Support\Facades\File;
use DB;
use App\Helper\Reply;
use App\Helper\Files;


class SettingController extends BaseController
{
    public function index()
    {
        $user = User::all();
        return view ('admin.settings.index', compact('user'));
    }

    public function searchPic(Request $request){
        $searchTerm = $request->q;
        $users = User::role('Vendor')->where('name', 'like', $searchTerm.'%')
            ->get();

        return response()->json($users);
    }

    public function update(SettingRequest $request, $id){
        $setting = CompanySetting::first();
        $setting->company_name = $request->company_name;
        $setting->company_email = $request->company_email;
        $setting->company_phone = $request->company_phone;
        $setting->company_address = $request->company_address;
        $setting->company_city = $request->company_city;
        $setting->user_id = $request->user_id;
        if ($request->hasFile('company_logo')) {
            $setting->company_logo = Files::upload($request->company_logo,'company_logo');
        }
        $setting->save();

        $notification = array(
            'message' => 'Data Berhasil Diubah!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
