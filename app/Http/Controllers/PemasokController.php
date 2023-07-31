<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePemasokRequest;
use App\Http\Requests\UpdatePemasokRequest;
use App\Models\Pemasok;
use Illuminate\Support\Facades\Request;

class PemasokController extends Controller {
	/**
	 * Display a listing of the resource.
	 */

	public function index(Request $request) {
		$searchPemasok = request()->query('search');
		if (!empty('search')) {
			$dataPemasok = Pemasok::where('pemasok.nama_pemasok', 'ILIKE', $searchPemasok . '%')
				->orWhere('pemasok.domisili', 'ILIKE', $searchPemasok . '%')
				->paginate(10)->fragment('pms');
		} else {
			$dataPemasok = Pemasok::paginate(10)->fragment('pms');
		}

		return view('pemasok.index')->with(
			[
				'pemasok' => $dataPemasok,
				'searchPemasok' => $searchPemasok,
			]
		);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StorePemasokRequest $request) {
		$validate = $request->validated();

		$pemasok = new Pemasok;
		$pemasok->nama_pemasok = $request->txtpemasok;
		$pemasok->domisili = $request->txtdomisili;
		$pemasok->save();

		return redirect('pemasok')->with('msg', 'Pemasok succesfully added');
	}

	/**
	 * Display the specified resource.
	 */
	public function show($id_pemasok) {
		$data = Pemasok::find($id_pemasok);
		return view('pemasok.edit')->with(
			[
				'txtid' => $id_pemasok,
				'txtpemasok' => $data->nama_pemasok,
				'txtdomisili' => $data->domisili,
			]
		);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdatePemasokRequest $request, $id_pemasok) {
		$data = Pemasok::find($id_pemasok);
		$data->nama_pemasok = $request->txtpemasok;
		$data->domisili = $request->txtdomisili;
		$data->save();

		return redirect('pemasok')->with('msg', 'Pemasok succesfully updated');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy($id_pemasok) {
		$data = Pemasok::find($id_pemasok);
		$data->delete();
		return redirect('pemasok')->with('msg', 'Pemasok succesfully deleted');
	}
}
