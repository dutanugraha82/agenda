@extends('master')
@section('pageTitle')
    {{ $dataUser->name }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="mb-3">
            <label for="name">Name :</label>
            <input type="text" readonly class="form-control" value="{{ $dataUser->name }}">
        </div>
        <div class="mb-3">
            <label for="email">Email :</label>
            <input type="text" readonly class="form-control" value="{{ $dataUser->name }}">
        </div>
        <div class="mb-3">
            <label for="name">Role :</label>
            <input type="text" readonly class="form-control" value="{{ $dataUser->name }}">
        </div>
        @if($dataUser->unit_id != NULL)
        <div class="mb-3">
            <label for="name">Unit</label>
            <input type="text" readonly class="form-control" value="{{ $dataUser->Unit->unit_name }}">
        </div>
        @else
        <div class="mb-3">
            <label for="name">Unit</label>
            <input type="text" readonly class="form-control" value="NULL">
        </div>
        @endif
        <div class="my-5 container">
            <div class="d-flex" style="justify-content: space-between">
                <a href="/superadmin/users" style="width: 5rem;" class="btn btn-warning">Back</a>
                <form action="/superadmin/users/{{ $dataUser->id }}" method="POST">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger">Delete {{ $dataUser->name }}</button>
                </form>
            </div>
        </div>
    </div>
    
@endsection