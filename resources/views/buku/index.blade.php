
@extends('layout.master')

@section('title', 'Daftar Buku')

@section('content')
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h2>Daftar Buku</h2>
            <a href="{{ route('buku.create') }}" class="btn btn-primary float-right">Tambah Buku</a>
          </div>
          <div class="card-body">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Penulis</th>
                  <th>Harga</th>
                  <th>Tanggal Terbit</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data_buku as $buku)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $buku->judul }}</td>
                  <td>{{ $buku->penulis }}</td>
                  <td>{{ "Rp. ".number_format($buku->harga, 2,',','.')}}</td>
                  <td>{{ $buku->tanggal_terbit }}</td>
                  <td>
                    <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                    <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-primary btn-sm">Edit</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection