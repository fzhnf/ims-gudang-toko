<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePemasokRequest;
use App\Http\Requests\UpdatePemasokRequest;
use App\Models\Pemasok;
use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;

class PemasokController extends Controller {
	/**
	 * Display a listing of the resource.
	 */

	public function index(Request $request) {
		$searchPemasok = $request->query('search');
		$sortBy = $request->query('sort');

		$query = Pemasok::query();
		if (!empty($searchPemasok)) {
			$query->where(function (Builder $q) use ($searchPemasok) {
				$q->where('nama_pemasok', 'ILIKE',  $searchPemasok . '%')
					->orWhere('domisili', 'ILIKE',  $searchPemasok . '%');
			});
		}

		if ($sortBy === 'nama_pemasok_az') {
			$query->orderBy('nama_pemasok', 'asc');
		} elseif ($sortBy === 'nama_pemasok_za') {
			$query->orderBy('nama_pemasok', 'desc');
		} elseif ($sortBy === 'domisili_az') {
			$query->orderBy('domisili', 'asc');
		} elseif ($sortBy === 'domisili_za') {
			$query->orderBy('domisili', 'desc');
		} else {
			// Default sorting if no sort parameter is provided
			$query->orderBy('nama_pemasok', 'asc');
		}

		$dataPemasok = $query->paginate(10)->appends(['search' => $searchPemasok, 'sort' => $sortBy])->fragment('pms');

		return view('pemasok.index')->with([
			'pemasok' => $dataPemasok,
			'searchPemasok' => $searchPemasok,
			'sortBy' => $sortBy,
		]);
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
