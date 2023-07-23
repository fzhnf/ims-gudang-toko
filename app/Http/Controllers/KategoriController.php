<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pemasok;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index() 
    {
        return view('kategori.index')->with([
            'kategori' => Kategori::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKategoriRequest $request)
    {
        $validate = $request->validated();
        
        // $pemasok = Pemasok::find($request->txtnamapemasok); Fitur untuk auto bikin relasi
        $kategori = new Kategori;
        $kategori->nama_kategori = $request->txtkategori;
        $kategori->save();

        return redirect('kategori')->with('msg','Kategori succesfully added');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Kategori::find($id);
        return view('kategori.edit')->with([
            'txtid' => $id,
            'txtkategori' => $data->nama_kategori,
            // 'txtnamapemasok' => $data->pemasok
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriRequest $request, $id)
    {
        $data = Kategori::find($id);
        $data->nama_kategori = $request->txtkategori;
        $data->pemasok = $request->txtnamapemasok;
        $data->save();

        return redirect('kategori')->with('msg','Kategori succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Kategori::find($id);
        $data->delete();
        return redirect('kategori')->with('msg','Kategori succesfully deleted');
    }
}
