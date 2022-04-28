@extends('layouts.app')

@section('content')
<div>
    <h2>Edit Kategori Produk</h2>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="post" action="{{action('KategoriController@update', $id)}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" class="form-control" name="nama_kategori" value="{{$kategori->nama_kategori}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="nama_kategori">Deskripsi Kategori</label>
                <input type="text" class="form-control" name="deskripsi_kategori" value="{{$kategori->deskripsi_kategori}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-3">
                <button type="submit" class="btn btn-success">Simpan Kategori Produk</button>
            </div>
            <div class="form-group col-md-2">
                <a href="{{ URL::previous() }}" class="btn btn-primary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection