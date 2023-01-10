@extends('master')
@section('pageTitle')
    Input Data Social Media
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <form action="/superadmin/unit-socmed" class="p-2" method="POST">
                @csrf
                <div class="my-3">
                    <label for="name">Platform Name</label>
                    <select class="form-control" name="account_name" id="">
                        <option value="">Choose Platform</option>
                        <option value="instagram">Instagram</option>
                        <option value="facebook">Facebook</option>
                        <option value="twitter">Twitter</option>
                        <option value="others">Others</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="url">URL</label>
                    <input type="text" class="form-control" name="url" required>
                </div>
                <div class="mb-3">
                    <label for="unit">Unit</label>
                    <select class="form-control" name="unit_id">
                        <option value="">Choose Unit</option>
                        @foreach ($dataUnit as $item)
                            <option value="{{ $item->id }}">{{ $item->unit_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="container">
                    <button type="submit" class="btn btn-primary">Submit Data</button>
                </div>
            </form>
        </div>
    </div>
@endsection