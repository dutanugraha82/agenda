@extends('master')
@section('pageTitle')
    Edit Unit Social Media
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <form action="/superadmin/update-unit-socmed/{{ $dataSocmed->id }}" class="p-2" method="POST">
                @csrf
                @method('put')
                <div class="my-3">
                    <label for="name">Platform Name</label>
                    <select name="name_unit_socmed" class="form-control">
                       <option value="{{ $dataSocmed->name_unit_socmed }}">{{ Str::ucfirst($dataSocmed->name_unit_socmed) }}</option>
                       <option value="instagram">Instagram</option>
                        <option value="facebook">Facebook</option>
                        <option value="twitter">Twitter</option>
                        <option value="others">Others</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="url">URL</label>
                    <input type="text" class="form-control" value="{{ $dataSocmed->url }}" name="url">
                </div>
                <div class="mb-3">
                    <label for="unit">Unit Name</label>
                    <select name="unit_id" id="" class="form-control">
                            <option value="{{ $dataSocmed->unit->id }}">{{ Str::ucfirst($dataSocmed->unit->unit_name) }}</option>
                            @foreach ($dataUnit as $item)
                                <option value="{{ $item->id }}">{{ Str::ucfirst($item->unit_name) }}</option>
                            @endforeach
                    </select>
                </div>
                <div class="mt-5 mb-3">
                    <button type="submit" class="btn btn-warning">Update Data</button>
                </div>
            </form>
        </div>
    </div>
@endsection