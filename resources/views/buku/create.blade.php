@extends('layout.master')

@section('title', 'Buku Baru')
@section('content')
    <h1>tambah</h1>

    <form action="{{ route('buku.store' ) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul Buku">
        </div>
        <div class="form-group">
            <label for="penulis">Penulis</label>
            <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Penulis Buku">
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga Buku">
        </div>
        <div class="form-group">
            <label for="tanggal_terbit">Tgl. Terbit</label>
            <input type="text" class="form-control" id="tanggal_terbit" name="tanggal_terbit" placeholder="Tanggal Terbit Buku">
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection