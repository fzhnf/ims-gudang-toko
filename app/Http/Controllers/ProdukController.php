<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use App\Models\Kategori;
use App\Models\Pemasok;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller {
	public function index() {
		$searchProduk = request()->query('search');
		$sortBy = request()->query('sort');

		$dataProdukQuery = Produk::query();

		if (!empty($searchProduk)) {
			$dataProdukQuery->where('nama_produk', 'ILIKE', $searchProduk . '%');
		}

		if ($sortBy == 'nama_produk_az') {
			$dataProdukQuery->orderBy('nama_produk', 'asc');
		} elseif ($sortBy == 'nama_produk_za') {
			$dataProdukQuery->orderBy('nama_produk', 'desc');
		} elseif ($sortBy == 'nama_kategori_az') {
			$dataProdukQuery->join('kategori', 'produks.kategori_id', '=', 'kategori.id_kategori')
				->orderBy('kategori.nama_kategori', 'asc');
		} elseif ($sortBy == 'nama_kategori_za') {
			$dataProdukQuery->join('kategori', 'produks.kategori_id', '=', 'kategori.id_kategori')
				->orderBy('kategori.nama_kategori', 'desc');
		} elseif ($sortBy == 'nama_pemasok_az') {
			$dataProdukQuery->join('pemasok', 'produks.pemasok_id', '=', 'pemasok.id_pemasok')
				->orderBy('pemasok.nama_pemasok', 'asc');
		} elseif ($sortBy == 'nama_pemasok_za') {
			$dataProdukQuery->join('pemasok', 'produks.pemasok_id', '=', 'pemasok.id_pemasok')
				->orderBy('pemasok.nama_pemasok', 'desc');
		}

		$dataProduk = $dataProdukQuery->with('kategori', 'pemasok')->paginate(20);

		return view('produk.index', [
			'produk' => $dataProduk,
			'searchProduk' => $searchProduk,
			'sortBy' => $sortBy,
		]);
	}

	public function store(StoreProdukRequest $request) {
		$validated = $request->validated();

		$kategoriName = ucwords($validated['txtkategori']);
		$pemasokName = ucwords($validated['txtpemasok']);

		$kategori = Kategori::firstOrCreate(['nama_kategori' => $kategoriName]);
		$pemasok = Pemasok::firstOrCreate(['nama_pemasok' => $pemasokName]);

		$produk = new Produk([
			'nama_produk' => $validated['txtproduk'],
			'quantity' => $validated['txtkuantitas'],
			'harga_per_pcs' => $validated['txthargaperpcs'],
			'kategori_id' => $kategori->id_kategori,
			'pemasok_id' => $pemasok->id_pemasok,
		]);

		$produk->save();

		return redirect('produk')->with('msg', 'Produk successfully added');
	}

	public function show($id_produk) {
		$data = Produk::find($id_produk);

		return view('produk.edit', [
			'txtid' => $id_produk,
			'txtproduk' => $data->nama_produk,
			'txtkategori' => optional($data->kategori)->nama_kategori,
			'txtpemasok' => optional($data->pemasok)->nama_pemasok,
			'txtkuantitas' => $data->quantity,
			'txthargaperpcs' => $data->harga_per_pcs,
		]);
	}

	public function update(UpdateProdukRequest $request, $id_produk) {
		$validated = $request->validated();
		$data = Produk::find($id_produk);

		$data->nama_produk = $request->txtproduk;
		$data->quantity = $request->txtkuantitas;
		$data->harga_per_pcs = $request->txthargaperpcs;

		if (!empty($validated['txtkategori'])) {
			$kategoriName = ucwords($validated['txtkategori']);
			$kategori = Kategori::updateOrCreate(
				['id_kategori' => optional($data->kategori)->id_kategori],
				['nama_kategori' => $kategoriName]
			);
			$data->kategori_id = $kategori->id_kategori;
		}

		if (!empty($validated['txtpemasok'])) {
			$pemasokName = ucwords($validated['txtpemasok']);
			$pemasok = Pemasok::updateOrCreate(
				['id_pemasok' => optional($data->pemasok)->id_pemasok],
				['nama_pemasok' => $pemasokName]
			);
			$data->pemasok_id = $pemasok->id_pemasok;
		}

		$data->save();

		return redirect('produk')->with('msg', 'Produk successfully updated');
	}

	public function destroy($id_produk) {
		$data = Produk::find($id_produk);

		$oldKategoriId = optional($data->kategori)->id_kategori;
		$oldPemasokId = optional($data->pemasok)->id_pemasok;

		$data->pemasok_id = null;
		$data->kategori_id = null;
		$data->save();

		$data->delete();

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
