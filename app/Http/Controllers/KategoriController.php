<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use Illuminate\Http\Request;


// class Kategori extends Model
// {
//     use HasFactory;

//     protected $table = 'kategori';
//     protected $fillable = ['nama_kategori'];

class KategoriController extends Controller
{
    // public function index()
    // {
    //     $kategori = Kategori::all();
    //     return view('kategori.index', compact('kategori'));
    // }
    public function index(Request $request) {
        if ($request->has('cari')) {
            $kategori = Kategori::where('nama_kategori', 'LIKE', '%'.$request->cari.'%')->get();
        } else {
            $kategori = Kategori::all();
        }
        return view('kategori.index', compact('kategori'));
    }

    public function show($id) {
        $kategori = Kategori::find($id);
        return response()->json($kategori);
    }

    public function store(Request $request) {
        Kategori::create($request->all());
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    public function update(Request $request, $id) {
        $kategori = kategori::find($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'pemasok' => $request->pemasok
        ]);
        return view('kategori.index', compact('kategori'));
    }

    public function destroy($id) {
        Kategori::destroy($id);
        return 'success';
    }



}
