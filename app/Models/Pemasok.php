<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model {

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

	public function __construct(array $attributes = []) {
		parent::__construct($attributes);

		if (empty($this->attributes['domisili'])) {
			$this->attributes['domisili'] = '-';
		}
	}
}
