@extends('master')
@section('pageTitle')
    Sunting Data Unit Situs
@endsection
@section('content')
<div class="container">
    <div class="card p-3">
        <form action="/adminunit/unitweb/{{ $dataUnitWeb->id }}" method="POST">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="name">Nama</label>
                <input type="text" class="form-control" name="name" value="{{ $dataUnitWeb->name }}">
            </div>
            <div class="mb-3">
                <label for="url">URL</label>
                <input type="text" class="form-control" name="url" value="{{ $dataUnitWeb->url }}">
            </div>
            <div class="mb-3">
                <label for="unit">Unit Universitas</label>
                <select name="unit_id" class="form-control" id="">
                    <option value="{{ $dataUnitWeb->unit_id }}">{{ $dataUnitWeb->Unit->unit_name }}</option>
                    @foreach ($dataUnit as $item)
                        <option value="{{ $item->id }}">{{ $item->unit_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-5">
                <button type="submit" class="btn btn-primary">Sunting Unit Situs</button>
            </div>
        </form>
    </div>
</div>
@endsection