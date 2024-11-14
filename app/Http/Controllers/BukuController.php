<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
   
    public function index()
    {
        $data_buku = Buku::all();

        return view('buku.index', compact('data_buku'));
    }


    public function create()
    {
        return view('buku.create');
    }

    
    public function store(Request $request)
    {
        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tanggal_terbit = $request->tanggal_terbit;
        $buku->save();
        return redirect('/buku') ->with('pesan', 'data buku disimpan');
        
    }

   
    public function show(string $id)
    {
        return view('buku.show', compact('buku'));
    }

   
    public function edit(string $id)
    {
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

  
    public function update(Request $request, string $id)
    {
        $buku = Buku::find($id);
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tanggal_terbit = $request->tanggal_terbit;

        $buku->save();
        return redirect('/buku');
    }

  
    public function destroy(string $id)
    {
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/buku');
    }
}
