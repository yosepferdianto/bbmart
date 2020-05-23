<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    protected $table = 'gudang';

    public function warehouses() {
        return $this->hasMany(Warehouse::class);
    }
}
