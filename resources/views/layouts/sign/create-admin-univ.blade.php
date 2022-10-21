@extends('master')
@section('title')
    SuperAdmin | input-adminUniv
@endsection
@section('pageTitle')
    Create Admin University
@endsection
@section('content')
    <div class="container">
        <div class="card p-2">
            <form action="/superadmin/store-adminuniv" method="POST">
                @csrf
                <div class="my-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" placeholder="Fill your name please" required>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" placeholder="Please fill with your university email" required>
                </div>
                <div class="mb-4">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" placeholder="Please make a good password" required>
                </div>
                <div class="container my-3 d-flex">
                    <a href="/superadmin/" style="width: 7rem" class="btn btn-warning">Back</a>
                    <button type="submit" class="btn btn-md btn-primary d-block ml-auto">Create Acoount</button>
                </div>
            </form>
        </div>
    </div>
@endsection