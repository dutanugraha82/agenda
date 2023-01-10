@extends('master')
@section('pageTitle')
    Sunting Data Unit {{ $dataUnitWeb->name }}
@endsection
@section('content')
<div class="container mt-3 ">
    <div class="card p-3 shadow">
        <form action="/superadmin/unitweb/{{ $dataUnitWeb->id }}" method="POST">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="name">Nama Unit Artikel Situs</label>
                <input type="text" class="form-control w-50" name="name" value="{{ $dataUnitWeb->name }}">
            </div>
            <div class="mb-3">
                <label for="url">URL Situs</label>
                <input type="text" class="form-control w-50" name="url" value="{{ $dataUnitWeb->url }}">
            </div>
            <div class="mb-3 form-control">
                <label for="unit">Unit Universitas</label>
                <select name="unit_id" id="getUnit" class="form-control w-50">
                    <option value="{{ $dataUnitWeb->unit_id }}">{{ $dataUnitWeb->unit->unit_name }}</option>
                </select>
                @error('unit_id')
                     <small class="text-danger">{{ $message }}</small>
                 @enderror
            </div>
        <div class="my-5 d-flex">
            <button type="submit" class="btn btn-primary">Sunting Data</button>
            <a href="/superadmin/unitweb" class="btn btn-md btn-warning ml-3">Kembali</a>
        </div>
        </form>
    </div>
</div>
@endsection
@push('js')
<script>
$(document).ready(function(){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


    $( "#getUnit" ).select2({
      ajax: {
        url: "{{route('getUnit')}}",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            _token: CSRF_TOKEN,
            search: params.term // search term
          };
        },
        processResults: function (response) {
          return {
            results: response
          };
        },
        cache: true
      }

    });

  });
</script>
@endpush