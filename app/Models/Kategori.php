<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{

    // public function pemasok()
    // {
    //     return $this->belongsTo(Pemasok::class, 'nama_kategori', 'id');
    // } entah ini masih kepake atau ga. blm ditest

    use HasFactory;
    protected $table = 'kategori';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = ['nama_kategori'];

    public function produk(){
        return $this->hasMany(Produk::class, 'kategori_id');
    }
}
