<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use App\Models\Produk;

// {
//     // public function kategori()
//     // {
//     //   return $this->hasMany(Kategori::class, 'nama_pemasok', 'id');
//     // }
//     use HasFactory;
//     protected $table = 'pemasok';
//     protected $primaryKey = 'id';
//     public $incrementing = false;
//     public $timestamps = true;
//     public $fillable = ['nama_pemasok', 'domisili'];
//
//     public function produk(){
//         return $this->hasMany(Produk::class, 'pemasok_id');
//     }
//     
// }

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('produk.index')->with(
            [
                'produks' => Produk::all()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProdukRequest $request)
    {
        $validate = $request->validated();

        $produk = new Produk;
        $produk->nama_produk = $request->txtnamaproduk;
        $produk->harga = $request->txtharga;
        $produk->stok = $request->txtstok;
        $produk->pemasok_id = $request->txtpemasok;
        $produk->kategori_id = $request->txtkategori;
        $produk->save();

        return redirect('produk')->with('msg', 'Produk succesfully added');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Produk::find($id);
        return view('produk.edit')->with(
            [
                'txtid' => $id,
                'txtnamaproduk' => $data->nama_produk,
                'txtharga' => $data->harga,
                'txtstok' => $data->stok,
                'txtpemasok' => $data->pemasok_id,
                'txtkategori' => $data->kategori_id
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    { 
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProdukRequest $request, $id)
    {
        $data = Produk::find($id);
        $data->nama_produk = $request->txtnamaproduk;
        $data->harga = $request->txtharga;
        $data->stok = $request->txtstok;
        $data->pemasok_id = $request->txtpemasok;
        $data->kategori_id = $request->txtkategori;
        $data->save();

        return redirect('produk')->with('msg', 'Produk succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Produk::find($id);
        $data->delete();

        return redirect('produk')->with('msg', 'Produk succesfully deleted');
    }
}
