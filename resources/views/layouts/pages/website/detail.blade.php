@extends('master')
@section('pageTitle')
    Detail {{ $dataWebsite->web_name }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="card shadow p-2">
                <div class="row">
                    <div class="col-md-2">
                        <img class="w-75" src="{{ asset('storage'.'/'.$dataWebsite->web_thumbnail) }}" alt="">
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="date">Web Name :</label>
                            <p style="text-decoration: underline" class="text-muted">{{ $dataWebsite->web_name }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="date">Web Date :</label>
                            <p style="text-decoration: underline" class="text-muted">{{ $dataWebsite->web_date }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="date">Web Address :</label>
                            <p style="text-decoration: underline" class="text-muted">{{ $dataWebsite->web_address }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="date">Web URL :</label>
                            <p style="text-decoration: underline" class="text-muted">{{ $dataWebsite->web_url }}</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="date">Unit :</label>
                            <p style="text-decoration: underline" class="text-muted">{{ $dataWebsite->Unit->unit_name }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="status">Status</label>
                            <div class="d-flex">
                                <p style="text-decoration: underline" class="text-muted">{{ $dataWebsite->web_status }}</p>
                            @if ($dataWebsite->web_status == 'pending')
                            @if (auth()->user()->role == 'admin_univ')
                            <div class="ml-3">
                                <form action="/adminuniv/website/{{ $dataWebsite->id }}/publish" method="POST">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-sm btn-success">Publish!</button>
                                </form>
                            </div>
                            @endif
                            @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="date">Type :</label>
                            <p style="text-decoration: underline" class="text-muted">{{ $dataWebsite->web_type }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="date">Category :</label>
                            <p style="text-decoration: underline" class="text-muted">{{ $dataWebsite->web_category }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="date">Document : </label>
                            <p style="text-decoration: underline" class="text-muted">{{ $dataWebsite->web_document }}</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="create">Created at :</label>
                            <p style="text-decoration: underline" class="text-muted">{{ $dataWebsite->created_at }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="create">Updated at :</label>
                            <p style="text-decoration: underline" class="text-muted">{{ $dataWebsite->updated_at }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-4">
            <div class="row">
                <div class="col-6">
                    @if(auth()->user()->role == "admin_univ")
                    <a href="/adminuniv/website" style="width: 12rem;" class="btn btn-warning btn-block">Back</a>
                    @elseif(auth()->user()->role == "admin_unit")
                    <a href="/adminunit/website" style="width: 12rem;" class="btn btn-warning btn-block">Back</a>
                    @elseif(auth()->user()->role == "super_admin")
                    <a href="/superadmin/website" style="width: 12rem;" class="btn btn-warning btn-block">Back</a>
                    @endif
                </div>
               @if (auth()->user()->role == "admin_unit")
               <div class="col-6">
                <form action="/adminunit/website/{{ $dataWebsite->id }}" method="POST">
                    @csrf
                    @method('delete')
                    <input type="hidden" value="{{ $dataWebsite->web_thumbnail }}" name="oldImage">
                    <button type="submit" class="btn btn-danger d-block ml-auto">Delete Data {{ $dataWebsite->web_name }}</button>
                </form>
            </div>
               @endif
                
            </div>
        </div>
    </div>
@endsection