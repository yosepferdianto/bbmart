<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    public function satuan(){
        return $this->belongsTo(Satuan::class, 'kode_satuan');
    }

    public function categories(){
        return $this->belongsTo(Categories::class, 'kode_kategori');
    }
}
