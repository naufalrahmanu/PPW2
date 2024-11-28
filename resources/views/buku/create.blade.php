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
        <div class="mb-3">
            <label for="picture" class="form-label">Book Picture</label>
            <input type="file" class="form-control @error('picture') is-invalid @enderror" id="picture" name="picture" value="{{ old('picture') }}">
            @error('picture')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection