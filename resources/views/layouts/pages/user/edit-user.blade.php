@extends('master')
@section('pageTitle')
    Edit User
@endsection
@section('content')
<form action="/superadmin/users/{{ $dataUser->id }}" method="POST">
    @csrf
    @method('put')
<div class="container-fluid">
    <div class="mb-3">
        <label for="name">Name :</label>
        <input type="text" class="form-control" value="{{ $dataUser->name }}">
    </div>
    <div class="mb-3">
        <label for="email">Email :</label>
        <input type="text" class="form-control" value="{{ $dataUser->email }}">
    </div>
    <div class="mb-3">
        <label for="name">Role :</label>
        <input type="text" class="form-control" value="{{ $dataUser->role }}">
    </div>
    <div class="mb-3">
        <label for="name">Unit</label>
        <select class="form-control" name="unit_id" id="">
            @if($dataUser->unit_id != NULL)
            <option value="{{ $dataUser->unit_id }}">{{ $dataUser->Unit->unit_name }}</option>
            @else
            <option value="">Null</option>
            @endif
            @foreach ($dataUnit as $item)
            <option value="{{ $item->id }}">{{ $item->unit_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="my-5 container">
        <div class="d-flex" style="justify-content: space-between">
            <a href="/superadmin/users" style="width: 5rem;" class="btn btn-warning">Back</a>
            <button type="submit" class="btn btn-primary">Update Data {{ $dataUser->name }}</button>
        </div>
    </div>
</div>
</form>
@endsection