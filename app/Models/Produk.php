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
		return $this->belongsTo(Kategori::class, 'kategori_id', 'id_kategori')->withDefault([
			'nama_kategori' => 'No Category',
		]);
	}

	public function pemasok() {
		return $this->belongsTo(Pemasok::class, 'pemasok_id', 'id_pemasok')->withDefault([
			'nama_pemasok' => 'No Supplier',
		]);
	}

	public function setNamaProdukAttribute($value) {
		$this->attributes['nama_produk'] = ucwords($value);
	}

	public $timestamps = true;

	protected static function boot() {
		parent::boot();
		static::saving(function ($produk) {
			$kategoriName = ucwords($produk->kategori->nama_kategori);
			$pemasokName = ucwords($produk->pemasok->nama_pemasok);

			$kategori = Kategori::firstOrCreate(['nama_kategori' => $kategoriName]);
			$pemasok = Pemasok::firstOrCreate(['nama_pemasok' => $pemasokName]);

			$produk->kategori_id = $kategori->id_kategori;
			$produk->pemasok_id = $pemasok->id_pemasok;
		});
	}
}
