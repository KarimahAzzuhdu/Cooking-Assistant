<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use App\Produk;

class ProdukController extends Controller
{
    //autentikasi
    public function __construct()
    {
        $this->middleware('auth');
    }
    //indeks produk yang ada
    public function index()
    {
        $produk = Produk::simplePaginate(10);
        $kategori = Kategori::all();
        return view('produk.index', compact('produk','kategori'));
    }
    //Fungsi Create
    public function create()
    {
        $kategori = Kategori::all();
        return view('produk.create', compact('kategori'));
    }
    //Fungsi Store (add product)
    public function store(Request $request)
    {
        if(Input::hasFile('gambar_produk'))
        {
            $produk = new Produk;
            $produk->nama_produk = $request->nama_produk;
            $produk->id_kategori = $request->id_kategori;
            $produk->harga_produk = $request->harga_produk;
            $produk->deskripsi_produk = $request->deskripsi_produk;
            $file = Input::file('gambar_produk');
            $file->move('uploads', $file->getClientOriginalName());
            $produk->gambar_produk = $file->getClientOriginalName();
            $produk->save();
            return redirect('produk')->with('success', 'Produk berhasil ditambahkan');
        }
    }
    //Fungsi Edit 
    public function edit($id)
    {
        $produk = Produk::find($id);
        $kategori = Kategori::all();
        return view('produk.edit', compact('produk', 'id', 'kategori'));
    }
    //Fungsi Update
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        $produk->nama_produk = $request->get('nama_produk');
        $kategori = Kategori::find($request->get('id_kategori'));
        $produk->kategori()->associate($kategori);
        $produk->harga_produk = $request->get('harga_produk');
        $produk->deskripsi_produk = $request->get('deskripsi_produk');
        if(Input::hasFile('gambar_produk'))
        {
            $file = Input::file('gambar_produk');
            $file->move('uploads', $file->getClientOriginalName());
            $produk->gambar_produk = $file->getClientOriginalName();
        }
        $produk->save();
        return redirect('produk')->with('success', 'Produk berhasil diperbaharui');
    }
    //Fungsi Destroy (delete product)
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        return redirect('produk')->with('success', 'Produk berhasil dihapus');
    }
}
