<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use App\Models\Produk;
use Symfony\Component\HttpFoundation\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchProduk = request()->query('search');
        $dataProdukQuery = Produk::query();

        if (!empty($searchProduk)) {
            $dataProdukQuery->where('produks.nama_produk', 'ILIKE', $searchProduk . '%');
        }
        $dataProduk = $dataProdukQuery->with('kategori', 'pemasok')
            ->paginate(20)
            ->fragment('prd');

        return view('produk.index')->with([
            'produk' => $dataProduk,
            'searchProduk' => $searchProduk
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProdukRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
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
    public function update(UpdateProdukRequest $request, Produk $produk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        //
    }
}
