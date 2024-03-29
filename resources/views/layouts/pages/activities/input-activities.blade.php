@extends('master')
@section('pageTitle')
    Input Data Activities
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card p-3">
            <form action="/adminunit/activities" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="act_name" placeholder="Input Activities Name" required>
                    </div>
                    <div class="mb-3 d-block">
                        <label for="date">Date <span><i>(activties date)</i></span></label>
                        <input type="date" class="form-control" name="act_date" placeholder="Input Activities date" required>
                    </div>
                    <div class="mb-3">
                        <label for="name">Address</label>
                        <input type="text" class="form-control" name="act_address" placeholder="Input Activities Address" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="partisipant">Parcipants</label>
                        <input type="number" min="1" class="form-control" name="partisipant" placeholder="number of participants" required>
                    </div>
                    <div class="mb-3">
                        <label for="date">Type</label>
                        <select name="type" class="form-control">
                            <option value="">------ Choose Type Activities -----</option>
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                        </select>
                    </div>
                    <input type="text" name="act_status" value="pending" hidden>
                    <div class="mb-3">
                        <label for="unit">Unit</label>
                        <select name="unit_id" class="form-control">
                            <option value="">------ Choose Type Unit -----</option>
                            @foreach ($dataUnit as $item)
                            <option value="{{ $item->id }}">{{ $item->unit_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="container mt-5 mb-3 text-center">
                <button type="submit" class="btn btn-primary ">Submit Data Activities</button>
            </div>
            </form>
        </div>
    </div>
@endsection