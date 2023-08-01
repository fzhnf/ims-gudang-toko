<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model {
	use HasFactory;
	protected $table = 'produks';
	protected $primaryKey = 'id_produk';
	public $incrementing = true;
	public $fillable = ['nama_produk', 'quantity', 'harga_per_pcs', 'kategori_id', 'pemasok_id'];

	public function kategori() {
		return $this->belongsTo(Kategori::class, 'kategori_id', 'id_kategori');
	}

	public function pemasok() {
		return $this->belongsTo(Pemasok::class, 'pemasok_id', 'id_pemasok');
	}

	public function setNamaProdukAttribute($value) {
		$this->attributes['nama_produk'] = ucwords($value);
	}

	public $timestamps = true;
}
