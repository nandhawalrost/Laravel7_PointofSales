<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rinciantransaksi extends Model
{
    protected $table = 'rincian_transaksi';
    protected $fillable = ['id_transaksi','nama_produk','qty','harga'];
}
