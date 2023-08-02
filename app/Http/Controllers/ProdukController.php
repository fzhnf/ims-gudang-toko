<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use App\Models\Kategori;
use App\Models\Pemasok;
use App\Models\Produk;
use DB;
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

		$kategoriName = ucwords($validated['txtkategori']);
		$pemasokName = ucwords($validated['txtpemasok']);
		// Check if the kategori already exists, otherwise create a new one
		$kategori = Kategori::firstOrCreate(['nama_kategori' => $kategoriName]);

		// Check if the pemasok already exists, otherwise create a new one
		$pemasok = Pemasok::firstOrCreate(['nama_pemasok' => $pemasokName]);

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
		// return view('produk.edit')->with('produk', $produk);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateProdukRequest $request, $id_produk) {
		$validated = $request->validated();
		$data = Produk::find($id_produk);

		$data->nama_produk = $request->txtproduk;
		$data->quantity = $request->txtkuantitas;
		$data->harga_per_pcs = $request->txthargaperpcs;

		// Simpan ID kategori dan ID pemasok sebelumnya
		$oldKategoriId = $data->kategori_id;
		$oldPemasokId = $data->pemasok_id;

		if (!empty($validated['txtkategori'])) {
			$kategoriName = ucwords($validated['txtkategori']);
			$kategori = Kategori::updateOrCreate(
				['id_kategori' => $oldKategoriId], // Set ID kategori eksplisit
				['nama_kategori' => $kategoriName]
			);
			$data->kategori()->associate($kategori);
		}

		if (!empty($validated['txtpemasok'])) {
			$pemasokName = ucwords($validated['txtpemasok']);
			$pemasok = Pemasok::updateOrCreate(
				['id_pemasok' => $oldPemasokId], // Set ID pemasok eksplisit
				['nama_pemasok' => $pemasokName]
			);
			$data->pemasok()->associate($pemasok);
		}

		$data->save();

		// Update the kategori and pemasok in their respective tables if the association has changed
		if ($oldKategoriId !== $data->kategori_id) {
			DB::table('kategori')->where('id_kategori', $oldKategoriId)->update(['nama_kategori' => $kategoriName]);
		}

		if ($oldPemasokId !== $data->pemasok_id) {
			DB::table('pemasok')->where('id_pemasok', $oldPemasokId)->update(['nama_pemasok' => $pemasokName]);
		}

		return redirect('produk')->with('msg', 'Produk successfully updated');
	}
	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy($id_produk) {
		$data = Produk::find($id_produk);

		// Simpan ID kategori dan ID pemasok sebelumnya
		$oldKategoriId = $data->kategori_id;
		$oldPemasokId = $data->pemasok_id;

		// Hapus relasi dengan pemasok dan kategori (reset to NULL)
		$data->pemasok_id = null;
		$data->kategori_id = null;
		$data->save();

		// Hapus produk dari database
		$data->delete();

		// Jika pemasok atau kategori sudah tidak memiliki produk terkait, hapus dari database
		// (Kode yang menghapus kategori dan pemasok saat tidak memiliki produk terkait telah dihapus)

		// Update the kategori and pemasok in their respective tables if the association has changed
		if ($oldKategoriId !== null) {
			$kategoriName = Kategori::find($oldKategoriId)->nama_kategori;
			DB::table('kategori')->where('id_kategori', $oldKategoriId)->update(['nama_kategori' => $kategoriName]);
		}

		if ($oldPemasokId !== null) {
			$pemasokName = Pemasok::find($oldPemasokId)->nama_pemasok;
			DB::table('pemasok')->where('id_pemasok', $oldPemasokId)->update(['nama_pemasok' => $pemasokName]);
		}

		return redirect('produk')->with('msg', 'Produk successfully deleted');
	}
}
