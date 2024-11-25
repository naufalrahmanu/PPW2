@extends('layout.master')

@section('title', 'Buku Baru')
@section('content')
    <h1>tambah</h1>

<form action="{{ route('buku.store' ) }}" method="POST">
    @csrf
    <div>Judul <input type="text" name="judul" ></div>
        <div>Penulis <input type="text" name="penulis" ></div>
        <div>Harga <input type="text" name="harga" ></div>
        <div>Tgl. Terbit <input type="text" name="tanggal_terbit"></div>
        <div class="mb-3">
            <label for="picture" class="form-label">Book Picture</label>
            <input type="file" class="form-control @error('picture') is-invalid @enderror" id="picture" name="picture"
                value="{{ old('picture') }}">
            @error('picture')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection