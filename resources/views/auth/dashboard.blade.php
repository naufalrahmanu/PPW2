@extends('layout.master')

@section('title','Dashboard')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">dashboard</div>
            <div class="card-body">
                Halo, {{ Auth::user()->name }}

                <a class="btn btn-primary d-block mt-3" href="{{ route('buku.index') }}">Daftar buku</a>
            </div>
        </div>
    </div>
</div>