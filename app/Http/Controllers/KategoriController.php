<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use App\Models\Kategori;
// use Illuminate\Support\Facades\Request;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;

class KategoriController extends Controller {
	/**
	 * Display a listing of the resource.
	 */

	public function index(Request $request) {
		$searchKategori = request()->query('search');
		$sortBy = $request->query('sort');

		$query = Kategori::query();

		if (!empty($searchKategori)) {
			$query->where('kategori.nama_kategori', 'ILIKE', $searchKategori . '%');
		}

		if ($sortBy === 'nama_kategori_az') {
			$query->orderBy('nama_kategori', 'asc');
		} elseif ($sortBy === 'nama_kategori_za') {
			$query->orderBy('nama_kategori', 'desc');
		}

		$dataKategori = $query->paginate(10)->fragment('ktg');

		return view('kategori.index')->with(
			[
				'kategori' => $dataKategori,
				'searchKategori' => $searchKategori,
				'sortBy' => $sortBy,
			]
		);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreKategoriRequest $request) {
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
	public function show($id_kategori) {
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
	public function update(UpdateKategoriRequest $request, $id_kategori) {
		$data = Kategori::find($id_kategori);
		$data->nama_kategori = $request->txtkategori;
		$data->save();

		return redirect('kategori')->with('msg', 'Kategori succesfully updated');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy($id_kategori) {
		$data = Kategori::find($id_kategori);
		$data->delete();
		return redirect('kategori')->with('msg', 'Kategori succesfully deleted');
	}
}
