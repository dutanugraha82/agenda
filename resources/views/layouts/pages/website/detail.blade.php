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
                <div class="col-4">
                    @auth('adminunit')
                    <a href="/adminunit/website" style="width: 12rem;" class="btn btn-warning btn-block">Back</a>
                    @endauth
                    @auth('adminuniv')
                    <a href="/adminuniv/website" style="width: 12rem;" class="btn btn-warning btn-block">Back</a>
                    @endauth
                </div>
                @if ($dataWebsite->web_status == 'published')
                <div class="col-4 text-center">
                    <p class="bg-success p-2 rounded" style="width:20rem">Website Status : Published</p>
                </div>
                @else
                <div class="col-4">
                    <form action="/adminuniv/website/{{ $dataWebsite->id }}/publish" method="POST" class="text-center">
                        @csrf
                        @method('put')
                        <button type="submit" style="width: 12rem;" class="btn btn-success">Publish!</button>
                    </form>
                </div>
                @endif
               
                <div class="col-4">
                    <form action="/adminuniv/website/{{ $dataWebsite->id }}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="hidden" value="{{ $dataWebsite->web_thumbnail }}" name="oldImage">
                        <button type="submit" class="btn btn-danger d-block ml-auto">Delete Data {{ $dataWebsite->web_name }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection