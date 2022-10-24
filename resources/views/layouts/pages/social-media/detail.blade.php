@extends('master')
@section('pageTitle')
    Detail {{ $dataSocialMed->socmed_name }}
@endsection
@section('content')
<div class="container-fluid">
    <div class="card p-3">
        <div class="my-3">
            <img style="width: 23rem" class="card d-block mx-auto" src="{{ asset('storage'.'/'.$dataSocialMed->thumbnail) }}" alt="">
            <p class="text-center">Url : {{ $dataSocialMed->socmed_url }}</p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" value="{{ $dataSocialMed->socmed_name }}" readonly>
                </div>
                <div class="mb-3 d-block">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" value="{{ $dataSocialMed->socmed_date }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="name">Address</label>
                    <input type="text" class="form-control" value="{{ $dataSocialMed->socmed_address }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="partisipant">Caption</label>
                    <textarea class="form-control" id="" cols="30" rows="10" readonly>{{ $dataSocialMed->caption }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="date">Category</label>
                    <input type="text" class="form-control" value="{{ $dataSocialMed->category }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" value="{{ $dataSocialMed->socmed_status }}" readonly>
                    @if (auth()->user()->role == 'admin_univ')
                    <form action="/adminuniv/social-media/{{ $dataSocialMed->id }}/publish" method="POST">
                    @csrf
                    @method('put')
                    <button class="btn btn-sm btn-success mt-4">Publish {{ $dataSocialMed->socmed_name }}</button>
                    </form>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="unit">Unit</label>
                    <input type="text" class="form-control" value="{{ $dataSocialMed->Unit->unit_name }}" readonly>
                </div>
            </div>
            <div class="mb-4">
                <p>Created at : {{ $dataSocialMed->created_at }}</p>
                <p>Updated at : {{ $dataSocialMed->updated_at }}</p>
            </div>
        </div>
        <div class="container-fluid" style="display: flex; justify-content: space-between">
            @if (auth()->user()->role == "admin_unit")
            <a href="/adminunit/social-media" style="width: 6rem;" class="btn btn-warning shadow">Back</a>  
              
             
            @elseif(auth()->user()->role == "admin_univ")
            <a href="/adminuniv/social-media" style="width: 6rem;" class="btn btn-warning shadow">Back</a> 
            @elseif(auth()->user()->role == "super_admin")
            <a href="/superadmin/social-media" style="width: 6rem;" class="btn btn-warning shadow">Back</a>
            @endif
            
            @if (auth()->user()->role == "admin_unit")
            <form action="/adminunit/social-media/{{ $dataSocialMed->id }}" method="POST">
            @csrf
            @method('delete')
            <input type="hidden" name="oldImage" value="{{ $dataSocialMed->thumbnail }}">
            <button type="submit" class="btn btn-danger">Delete Data {{ $dataSocialMed->socmed_name }}</button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection