@extends('master')
@section('pageTitle')
    Report Unit
@endsection
@section('content')
    <div class="container mt-4">
        <div class="row">
            @foreach ($data as $item)
            <div class="col-md">
                <a href="/superadmin/socmed/report/{{ $item->unit_id }}" class="list-group-item list-group-item-action active">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">{{ $item->unit->unit_name }}</h5>
                    </div>

                  </a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="my-5">
        <a href="/superadmin" class="btn btn-warning">Kembali</a>
    </div>
@endsection