<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use App\Models\Kategori;
use App\Models\Pemasok;
use App\Models\Produk;
use Symfony\Component\HttpFoundation\Request;

class ProdukController extends Controller {
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request) {
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
			'searchProduk' => $searchProduk,
		]);

	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreProdukRequest $request) {
		$validated = $request->validated();

		// Check if the kategori already exists, otherwise create a new one
		$kategori = Kategori::firstOrCreate(['nama_kategori' => $validated['txtkategori']]);

		// Check if the pemasok already exists, otherwise create a new one
		$pemasok = Pemasok::firstOrCreate(['nama_pemasok' => $validated['txtpemasok']]);

		// Create the new Produk instance with the provided data and the IDs of kategori and pemasok
		$produk = new Produk([
			'nama_produk' => $validated['txtproduk'],
			'quantity' => $validated['txtkuantitas'],
			'harga_per_pcs' => $validated['txthargaperpcs'],
			'kategori_id' => $kategori->id_kategori,
			'pemasok_id' => $pemasok->id_pemasok,
		]);

		// Save the new Produk to the database
		$produk->save();

		return redirect('produk')->with('msg', 'Produk successfully added');
	}
	/**
	 * Display the specified resource.
	 */
	public function show($id_produk) {
		$data = Produk::find($id_produk);
		return view('produk.edit')->with(
			[
				'txtid' => $id_produk,
				'txtproduk' => $data->nama_produk,
				'txtkategori' => $data->kategori->nama_kategori,
				'txtpemasok' => $data->pemasok->nama_pemasok,
				'txtkuantitas' => $data->quantity,
				'txthargaperpcs' => $data->harga_per_pcs,
			]
		);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Produk $produk) {
		return view('produk.edit')->with('produk', $produk);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateProdukRequest $request, Produk $produk) {
		$data->nama_produk = $request->txtproduk;
		$data->kategori_id = $request->id_kategori;
		$data->pemasok_id = $request->id_pemasok;
		$data->quantity = $request->txtkuantitas;
		$data->harga_per_pcs = $request->txthargaperpcs;
		$data->save();

		return redirect('produk')->with('msg', 'Produk succesfully updated');

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy($id_produk) {
		$data = Produk::find($id_produk);
		$data->delete();
		return redirect('produk')->with('msg', 'Produk succesfully deleted');

	}
}
