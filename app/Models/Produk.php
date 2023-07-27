<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model {
	use HasFactory;
	protected $table = 'produks';
	protected $primaryKey = 'id_produk';
	public $incrementing = false;
	public $fillable = ['nama_produk', 'quantity', 'harga_per_pcs'];

	public function kategori() {
		return $this->belongsTo(Kategori::class, 'kategori_id');
	}

	public function pemasok() {
		return $this->belongsTo(Pemasok::class, 'pemasok_id');
	}

	public $timestamps = true;
}
