@extends('master')
@section('pageTitle')
    Detail {{ $dataActivities->act_name }}
@endsection
@section('content')
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
                    @if (auth()->user()->role == 'admin_univ')
                    <form action="/adminuniv/activities/{{ $dataActivities->id }}/publish" method="POST">
                    @csrf
                    @method('put')
                    <button  type="submit" class="btn btn-sm btn-success mt-4">Publish {{ $dataActivities->act_name }}</button>
                    </form>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="unit">Unit</label>
                    <input type="text" class="form-control" value="{{ $dataActivities->Unit->unit_name }}" readonly>
                </div>
            </div>
        </div>
        <div class="container-fluid" style="display: flex; justify-content: space-between">
            @if (auth()->user()->role == "admin_unit")
            <a href="/adminunit/activities" style="width: 6rem;" class="btn btn-warning shadow">Back</a>
            @elseif(auth()->user()->role == "admin_univ")
            <a href="/adminunit/activities" style="width: 6rem;" class="btn btn-warning shadow">Back</a>
            @elseif(auth()->user()->role == "super_admin")
            <a href="/superadmin/activities" style="width: 6rem;" class="btn btn-warning shadow">Back</a>
            @endif
        @if (auth()->user()->role == "admin_unit")
            <form action="/adminunit/activities/{{ $dataActivities->id }}" method="POST">
                @csrf
                @method('delete')
            <button type="submit" style="min-width: 6rem" class="btn btn-danger shadow">Delete {{ $dataActivities->act_name }}</a>
        @endif
        </div>
    </div>
</div>
</form>
@endsection