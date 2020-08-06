<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use SoftDeletes;
    protected $table = 'barangs';
    protected $primaryKey = 'id_barang';
    protected $fillable = ['nama_barang','harga_beli','harga_jual','stok','foto_barang'];
}
