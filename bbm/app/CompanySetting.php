<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $appends = [
        'logo_url',
        'formatted_phone_number',
        'formatted_address',
        'formatted_website'
    ];
    
    public function getLogoUrlAttribute()
    {
        if (is_null($this->company_logo)) {
            return asset('img/logo.png');
        }
        return asset('user-uploads/company_logo/' . $this->company_logo);
    }

    public function getFormattedPhoneNumberAttribute()
    {
        return $this->phone_number_format($this->company_phone);
    }

    public function getFormattedAddressAttribute()
    {
        return nl2br(str_replace('\\r\\n', "\r\n", $this->address));
    }

    public function getFormattedWebsiteAttribute()
    {
        return preg_replace('/^https?:\/\//', '', $this->website);
    }
}
