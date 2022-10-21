@extends('master')
@section('pageTitle')
    Edit Data Activities
@endsection
@section('content')
<div class="container-fluid">
    <div class="card p-3">
        <form action="/activities/{{ $dataActivities->id }}" method="POST">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="act_name" value="{{ $dataActivities->act_name }}" required>
                </div>
                <div class="mb-3 d-block">
                    <label for="date">Date <span><i>(activties date)</i></span></label>
                    <input type="date" class="form-control" name="act_date" value="{{ $dataActivities->act_date }}" required>
                </div>
                <div class="mb-3">
                    <label for="name">Address</label>
                    <input type="text" class="form-control" name="act_address" value="{{ $dataActivities->act_address }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="partisipant">Parcipants</label>
                    <input type="number" min="1" class="form-control" name="partisipant" value="{{ $dataActivities->partisipant }}" required>
                </div>
                <div class="mb-3">
                    <label for="date">Type</label>
                    <select name="type" class="form-control">
                        <option value="{{ $dataActivities->type }}">{{ $dataActivities->type }}</option>
                        @if ($dataActivities->type == 'public')
                            <option value="private">Private</option>
                        @else
                            <option value="public">Public</option>
                        @endif
                    </select>
                </div>
                <input type="text" name="act_status" value="pending" hidden>
                <div class="mb-3">
                    <label for="unit">Unit</label>
                    <select name="unit_id" class="form-control">
                        <option value="{{ $dataActivities->unit_id }}">{{$dataActivities->Unit->unit_name}}</option>
                        @foreach ($dataUnit as $item)
                        <option value="{{ $item->id }}">{{ $item->unit_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="container text-center mt-5 mb-3" style="display: flex; justify-content: space-between;">
            <a href="/activities" style="background-color: rgb(247, 247, 59);min-width: 6rem;" class="btn shadow">Back</a>
            <button type="submit" class="btn btn-success shadow">Update Data Activities</button>
        </div>
        </form>
    </div>
</div>
@endsection