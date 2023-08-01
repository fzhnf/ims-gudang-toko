<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use App\Models\Kategori;
use App\Models\Pemasok;
use App\Models\Produk;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
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
		// return view('produk.edit')->with('produk', $produk);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateProdukRequest $request, $id_produk) {
		// ...
		$data = Produk::find($id_produk);

		// Check if the kategori already exists, otherwise create a new one
		$kategori = Kategori::firstOrCreate(['nama_kategori' => $request->txtkategori]);

		// Check if the pemasok already exists, otherwise create a new one
		$pemasok = Pemasok::firstOrCreate(['nama_pemasok' => $request->txtpemasok]);

		$data->nama_produk = $request->txtproduk;
		$data->kategori_id = $kategori->id_kategori;
		$data->pemasok_id = $pemasok->id_pemasok;
		$data->quantity = $request->txtkuantitas;
		$data->harga_per_pcs = $request->txthargaperpcs;
		$data->save();

		// Update the kategori and pemasok in their respective tables
		DB::table('kategori')->where('id_kategori', $kategori->id_kategori)->update(['nama_kategori' => $request->txtkategori]);
		DB::table('pemasok')->where('id_pemasok', $pemasok->id_pemasok)->update(['nama_pemasok' => $request->txtpemasok]);

		return redirect('produk')->with('msg', 'Produk successfully updated');
	}
	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy($id_produk) {
		$data = Produk::find($id_produk);

		// Cari apakah ada relasi dengan pemasok atau kategori
		$pemasok = $data->pemasok;
		$kategori = $data->kategori;

		// Hapus relasi dengan pemasok dan kategori (reset to NULL)
		$data->pemasok_id = null;
		$data->kategori_id = null;
		$data->save();

		// Hapus produk dari database
		$data->delete();

		// Jika pemasok atau kategori sudah tidak memiliki produk terkait, hapus dari database
		try {
			if ($pemasok && $pemasok->produks->isEmpty()) {
				$pemasok->delete();
			}

			if ($kategori && $kategori->produks->isEmpty()) {
				$kategori->delete();
			}
		} catch (QueryException $e) {
			// Jika ada kesalahan saat menghapus pemasok atau kategori (karena masih ada produk lain yang terhubung),
			// tampilkan pesan kesalahan
			return redirect('produk')->with('error', 'Cannot delete pemasok or kategori because there are still products associated with it.');
		}

		return redirect('produk')->with('msg', 'Produk successfully deleted');
	}
}
