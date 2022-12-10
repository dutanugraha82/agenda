@extends('master')
@section('pageTitle')
    Tambah Unit Artikel
@endsection
@section('content')
    <div class="container">
        <div class="card p-3">
            <form action="{{ route(unitweb.create) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="mb-3">
                    <label for="url">URL</label>
                    <input type="text" class="form-control" name="url">
                </div>
                
            </form>
        </div>
    </div>
@endsection