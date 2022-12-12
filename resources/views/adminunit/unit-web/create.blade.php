@extends('master')
@section('pageTitle')
    Tambah Unit Artikel
@endsection
@section('content')
    <div class="container">
        <div class="card p-3">
            <form action="{{ route('unitweb.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="mb-3">
                    <label for="url">URL</label>
                    <input type="text" class="form-control" name="url">
                </div>
                <div class="mb-3">
                    <label for="unit">Unit Universitas</label>
                    <select name="unit_id" class="form-control" id="">
                        <option value="">-------- Pilih Unit -----------</option>
                        @foreach ($dataUnit as $item)
                            <option value="{{ $item->id }}">{{ $item->unit_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-5">
                    <button type="submit" class="btn btn-primary">Tambah Unit Artikel Situs</button>
                </div>
            </form>
        </div>
    </div>
@endsection