<?php

namespace App\Http\Controllers;

use App\CompanySetting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $settings;

    public function __construct()
    {
        $this->settings = CompanySetting::first();
        config(['app.name' => 'BBMart-'.$this->settings->company_name]);
        view()->share('settings', $this->settings);
    }
}
