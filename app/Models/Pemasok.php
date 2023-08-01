<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model {
	// public function kategori()
	// {
	//   return $this->hasMany(Kategori::class, 'nama_pemasok', 'id');
	// }
	use HasFactory;
	protected $table = 'pemasok';
	protected $primaryKey = 'id_pemasok';
	public $incrementing = true;
	public $timestamps = true;
	public $fillable = ['nama_pemasok', 'domisili'];

	public function produks() {
		return $this->hasMany(Produk::class, 'pemasok_id', 'id_pemasok');
	}

	public function setNamaPemasokAttribute($value) {
		$this->attributes['nama_pemasok'] = ucwords($value);
	}

	public function setDomisiliAttribute($value) {
		$this->attributes['domisili'] = ucwords($value);
	}

	// protected static function boot() {
	// 	parent::boot();

	// 	static::addGlobalScope('orderByNamaPemasok', function ($query) {
	// 		$query->orderBy('nama_pemasok', 'asc');
	// 	});
	// }
}
