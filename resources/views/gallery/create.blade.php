@extends('layout.master')

@section('title', 'Buku Baru')
@section('content')

<form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Buku Baru</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-end text-start">Title</label>
                            <div class="col-md-6">
                                <input type="text" name="title" id="title" class="form-control">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-end text-start">Description</label>
                            <div class="col-md-6">
                                <textarea rows="5" name="description" id="description" class="form-control"></textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-file" class="col-md-4 col-form-label text-md-end text-start">File input</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="file" name="picture" id="input-file" class="custom-file-input">
                                    <label for="input-file" class="custom-file-label">Choose File</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection