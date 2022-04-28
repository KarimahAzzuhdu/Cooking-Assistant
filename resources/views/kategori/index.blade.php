@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Kategori Produk</h2>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <p>{{\Session::get('success')}}</p>
    </div>
    @endif
    <div class="row">
        <div class="col-sm">
            <a href="{{action('KategoriController@create')}}" class="btn btn-primary">Tambah Kategori</a>
        </div>
        <div class="col-sm">
            <a href="{{action('ProdukController@index')}}">Produk</a>
        </div>
        <div class="col-sm">
            {{ $kategori->links()}}
        </div>
    </div>
    <br />
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th colspan="2">Action</t>
            </tr>
        </thead>
        <tbody>
            @foreach($kategori as $kat)
            <tr>
                <td>{{$kat['id_kategori']}}</td>
                <td>{{$kat['nama_kategori']}}</td>
                <td>{{$kat['deskripsi_kategori']}}</td>
                <td>{{$kat['gambar_kategori']}}</td>
                <td>
                    <a href="{{action('KategoriController@edit', $kat['id_kategori])}}" class="btn btn-warning">
                        Edit
                    </a>
                </td>
                <td>
                    <form action="{{action('KategoriController@destroy', $kat['id_kategori'])}}" method="post">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger" type="submit">DELETE</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection