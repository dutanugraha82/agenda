@extends('master')
@section('pageTitle')
    Edit Data Unit
@endsection
@section('content')
<div class="container">
    <form action="/superadmin/update-unit/{{$detailUnit->id}}" method="POST" class="p-2">
        @csrf
        @method('put')
        <div class="my-3">
            <label for="name"> Unit Name</label>
            <input type="text" class="form-control" placeholder="Please fill with name of unit" name="unit_name" value="{{ $detailUnit->unit_name }}">
        </div>
        <div class="mb-3">
            <label for="">Url</label>
            <input type="text" class="form-control" placeholder="Please fill with the URL of unit" name="url" value="{{ $detailUnit->url}}">
        </div>

        <div class="container my-4">
            <button type="submit" class="btn btn-primary d-block mx-auto">Update Data Unit</button>
        </div>
    </form>
</div>
@endsection
