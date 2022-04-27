<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;

class KategoriController extends Controller
{
    //autentikasi
    public function __construct()
    {
        $this->middleware('auth');
    }
    //indeks kategori yang ada
    public function index()
    {
        $data_kategori = Kategori::simplePaginate(10);
        return view('kategori.index', compact('data_kategori'));
    }
    //Fungsi Create
    public function create()
    {
        return view('kategori.create');
    }
    //Fungsi Store (add kategori)
    public function store(Request $request)
    {
        if(Input::hasFile('gambar_kategori'))
        {
            $kategori = new Kategori;
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->deskripsi_kategori = $request->deskripsi_kategori;
            $file = Input::file('gambar_kategori');
            $file->move('uploads', $file->getClientOriginalName());
            $kategori->gambar_kategori = $file->getClientOriginalName();
            $kategori->save();
            return back()->with('success', 'Kategori berhasil ditambahkan');
        }
    }
    //Fungsi Edit 
    public function edit($id)
    {
        $kategori = Kategori::find($id);
        return view('kategori.edit', compact('kategori','id'));
    }
    //Fungsi Update 
    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);
        $this->validate(request(), ['nama_kategori' => 'required']);
        $kategori->nama_kategori = $request->get('nama_kategori');
        $kategori->deskripsi_kategori = $request->get('deskripsi_kategori');
        if(Input::hasFile('gambar_kategori'))
        {
            $file = Input::file('gambar_kategori');
            $file->move('uploads', $file->getClientOriginalName());
            $produk->gambar_kategori = $file->getClientOriginalName();
        }
        $kategori->save();
        return redirect('kategori')->with('success', 'Kategori berhasil diperbaharui');
    }
    //Fungsi Destroy (delete kategori)
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
        return redirect('kategori')->with('success', 'Kategori berhasil dihapus');
    }
}
