<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    public function kategori()
    {
      return $this->hasMany(Kategori::class, 'nama_pemasok', 'id');
    }
    use HasFactory;
    protected $table = 'pemasok';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = true;
    
}
