@extends('master')
@section('pageTitle')
    Tambah Unit
@endsection
@section('content')
<div class="container">
 
 <div class="card p-2">
     <form action="{{route('unit.store')}}" method="POST">
         @csrf
         <div class="mb-3">
             <label for="name">Nama Unit</label>
             <input type="text" class="form-control " name="unit_name" value="{{ old('unit_name') }}">
             @error('unit_name')
                 <small class="text-danger">{{ $message }}</small>
             @enderror
         </div>
         <div class="mb-3">
             <label for="email">Alamat Situs / URL </label>
             <input type="text" class="form-control" name="url" value="{{ old('url') }}">
             @error('url')
                 <small class="text-danger">{{ $message }}</small>
             @enderror
         </div>
         <button type="submit" class="btn btn-primary">Tambah Unit</button>
     </form>
 </div>
</div>
@endsection
