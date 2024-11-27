@extends('layout.master')

@section('title', 'Buku Baru')
@section('content')

<div class="container mt-4">
    <h1>Edit</h1>
    <form action="{{ route('buku.update', $buku->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}">
        </div>
        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $buku->penulis }}">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control" id="harga" name="harga" value="{{ $buku->harga }}">
        </div>
        <div class="mb-3">
            <label for="tanggal_terbit" class="form-label">Tgl. Terbit</label>
            <input type="text" class="form-control" id="tanggal_terbit" name="tanggal_terbit" value="{{ $buku->tanggal_terbit }}">
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
</div>

@endsection