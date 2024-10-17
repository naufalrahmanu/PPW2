<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit</h1>

<form action="{{ route('buku.update', $buku->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>Judul <input type="text" name="judul" value="{{ $buku->judul }}"></div>
        <div>Penulis <input type="text" name="penulis" value="{{ $buku->penulis }}"></div>
        <div>Harga <input type="text" name="harga" value="{{ $buku->harga }}"></div>
        <div>Tgl. Terbit <input type="text" name="tanggal_terbit" value="{{ $buku->tanggal_terbit}}"></div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
</body>
</html>