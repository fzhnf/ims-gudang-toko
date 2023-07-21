<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use App\Http\Requests\StorePemasokRequest;
use App\Http\Requests\UpdatePemasokRequest;

class PemasokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return view('pemasok.index')->with([
        'pemasok' => Pemasok::all()
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePemasokRequest $request)
    {
      $validate = $request->validated();

      $pemasok = new Pemasok;
      $pemasok->nama_pemasok = $request->txtnamapemasok;
      $pemasok->domisili = $request->txtdomisili;
      $pemasok->save();

      return redirect('pemasok')->with('msg','Pemasok succesfully added');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
      $data = Pemasok::find($id);
      return view('pemasok.edit')->with([
        'txtid' => $id,
        'txtnamapemasok' => $data->nama_pemasok,
        'txtdomisili' => $data->domisili
      ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePemasokRequest $request, $id)
    {
      $data = Pemasok::find($id);
      $data->nama_pemasok = $request->txtnamapemasok;
      $data->domisili = $request->txtdomisili;
      $data->save();

      return redirect('pemasok')->with('msg','Pemasok succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      $data = Pemasok::find($id);
      $data->delete();

      return redirect('pemasok')->with('msg','Pemasok succesfully deleted');
    }
}
