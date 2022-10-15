@extends('master')
@section('pageTitle')
    Detail {{ $dataActivities->act_name }}
@endsection
@section('content')
<form action="/activities/{{ $dataActivities->id }}" method="POST">
    @csrf
    @method('delete')
<div class="container-fluid">
    <div class="card p-3">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" value="{{ $dataActivities->act_name }}" readonly>
                </div>
                <div class="mb-3 d-block">
                    <label for="date">Date <span><i>(activties date)</i></span></label>
                    <input type="date" class="form-control" value="{{ $dataActivities->act_date }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="name">Address</label>
                    <input type="text" class="form-control" value="{{ $dataActivities->act_address }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="partisipant">Parcipants</label>
                    <input type="number" min="1" class="form-control" value="{{ $dataActivities->partisipant }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="date">Type</label>
                    <input type="text" class="form-control" value="{{ $dataActivities->type }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" value="{{ $dataActivities->act_status }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="unit">Unit</label>
                    <input type="text" class="form-control" value="{{ $dataActivities->Unit->unit_name }}" readonly>
                </div>
            </div>
        </div>
        <div class="container-fluid" style="display: flex; justify-content: space-between">
            <a href="/activities" style="width: 6rem;" class="btn btn-warning shadow">Back</a>
            <button type="submit" style="min-width: 6rem" class="btn btn-danger shadow">Delete {{ $dataActivities->act_name }}</a>
        </div>
    </div>
</div>
</form>
@endsection