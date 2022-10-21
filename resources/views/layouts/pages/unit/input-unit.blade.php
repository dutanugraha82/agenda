@extends('master')
@section('pageTitle')
    Input Data Unit
@endsection
@section('content')
<div class="container">
    <form action="/superadmin/unit" method="POST" class="p-2">
        @csrf
        <div class="my-3">
            <label for="name"> Unit Name</label>
            <input type="text" class="form-control" placeholder="Please fill with name of unit" name="unit_name">
        </div>
        <div class="mb-3">
            <label for="">Url</label>
            <input type="text" class="form-control" placeholder="Please fill with the URL of unit" name="url">
        </div>

        <div class="container my-4">
            <button type="submit" class="btn btn-primary d-block mx-auto">Submit Data Unit</button>
        </div>
    </form>
</div>
@endsection
