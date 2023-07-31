<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
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
		$validate = $request->validated();

		$kategori = Kategori::where('nama_kategori', $request->txtkategori)->first();
		if (!$kategori) {
			$kategori = new Kategori;
			$kategori->nama_kategori = $request->txtkategori;
			$kategori->save();
		}

		$pemasok = Pemasok::where('nama_pemasok', $request->txtpemasok)->first();
		if (!$pemasok) {
			$pemasok = new Pemasok;
			$pemasok->nama_pemasok = $request->txtpemasok;
			$pemasok->save();
		}

		$produk = new Produk;

		$produk->nama_produk = $request->txtproduk;
		$produk->quantity = $request->txtkuantitas;
		$produk->harga_per_pcs = $request->txthargaperpcs;
		$produk->kategori_id = $request->id_kategori;
		$produk->pemasok_id = $request->id_pemasok;
		$produk->save();

		return redirect('produk')->with('msg', 'Produk succesfully added');
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateProdukRequest $request, Produk $produk) {
		$data = Produk::find($id_produk);
		$data->nama_produk = $request->txtproduk;
		$data->kategori = $request->txtkategori;
		$data->pemasok = $request->txtpemasok;
		$data->quantity = $request->txtkuantitas;
		$data->harga_per_pcs = $request->txtkuantitas;
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
