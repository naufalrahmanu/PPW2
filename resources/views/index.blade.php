<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('buku.create') }}" class=btn btn-primary>tambah buku</a>
    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tanggal Terbit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_buku as $buku)
            <tr>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ "Rp. ".number_format($buku->harga, 2,',','.')}}</td>
                <td>{{ $buku->tanggal_terbit }}</td>
                <td>
                <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" type="submit">Hapus</button>
                </form>
                <a href="{{ route('buku.edit', $buku->id) }}">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>