<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use Illuminate\Support\Facades\Request;



class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request) 
    {
        $searchKategori = request()->query('search');
        if(!empty($searchKategori)) {
            $dataKategori = Kategori::where('kategori.nama_kategori', 'ILIKE', $searchKategori . '%')
                ->paginate(10)->fragment('ktg');
        } else {
            $dataKategori = Kategori::paginate(10)->fragment('ktg');
        }
       
        return view('kategori.index')->with(
            [
            'kategori' => $dataKategori,
            'searchKategori' => $searchKategori
            ]
        );
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

        return redirect('kategori')->with('msg', 'Kategori succesfully added');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_kategori)
    {
        $data = Kategori::find($id_kategori);
        return view('kategori.edit')->with(
            [
            'txtid' => $id_kategori,
            'txtkategori' => $data->nama_kategori,
            // 'txtnamapemasok' => $data->pemasok
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriRequest $request, $id_kategori)
    {
        $data = Kategori::find($id_kategori);
        $data->nama_kategori = $request->txtkategori;
        $data->save();

        return redirect('kategori')->with('msg', 'Kategori succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_kategori)
    {
        $data = Kategori::find($id_kategori);
        $data->delete();
        return redirect('kategori')->with('msg', 'Kategori succesfully deleted');
    }
}
