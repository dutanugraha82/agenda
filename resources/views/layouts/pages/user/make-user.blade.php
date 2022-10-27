@extends('master')
@section('pageTitle')
    Admin Unit Registration
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card p-2">
            <form action="/superadmin/users" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label for="unit">Unit</label>
                   <select name="unit_id" id="" class="form-control">
                    @foreach ($dataUnit as $item)
                    <option value="">--------- Select Unit ---------</option>
                    <option value="{{ $item->id }}">{{ $item->unit_name }}</option>
                    @endforeach
                   </select>
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" name="password">
                </div>

                <button type="submit" class="btn btn-primary">Create Account!</button>
            </form>
        </div>
    </div>
@endsection